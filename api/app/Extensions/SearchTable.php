<?php

namespace App\Extensions;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class SearchTable
{

    public static function handle_search( Builder $query ,int $paginate = 15 ,bool $is_table = true ) : LengthAwarePaginator|Collection|\Jenssegers\Mongodb\Collection
    {
        $searches = request()->get("search") ;
        $sort = request()->get("sort") ;
        $per_page = request()->get("per_page") ;

        if( !empty($searches) && $searches != "{}" )
            foreach ( json_decode($searches,true) ?? [] as $search )
            {
                switch ( $search['type'] )
                {
                    case "like" :
                        $query->where( $search['key'],'like' ,"%{$search['val']}%" ) ;
                        break ;
                    case "equal" :
                        $query->whereRaw([ $search['key'] => [ '$eq' => $search['val'] ]]) ;
                        break ;
                    case "date" :
                        $sub_day = Carbon::parse( $search['val'])->subDay()->setHour(23)->setMinute(59)->setSecond(59) ;
                        $add_day = Carbon::parse( $search['val'])->addDay()->setHour(00)->setMinute(00)->setSecond(00) ;
                        $query->where( $search['key'],">" ,$sub_day )->where( $search['key'],"<" ,$add_day ) ;
                        break ;
                    case "datetime-bool" :
                        if( $search['val'] == "true" )
                            $query->whereNotNull( $search['key'] ) ;
                        elseif( $search['val'] == "false" )
                            $query->whereNull( $search['key'] ) ;
                        break ;
                    case "in" :
                        $query->whereIn( $search['key'] ,$search['val'] ) ;
                        break ;
                    case "relation-equal" :
                        $query->whereHas($search['relation'],fn( $query ) => $query->where($search['key'] ,$search['val'])) ;
                        break ;
                    case "relation-like" :
                        $query->whereHas($search['relation'],fn( $query ) => $query->where($search['key'] ,"like" ,"%{$search['val']}%")) ;
                        break ;
                    case "bool" :
                        if( $search['val']['key'] == '*' )
                            $query->whereNotNull( $search['key'] , ) ;
                        else
                            $query->whereNull( $search['key'] , ) ;
                        break ;
                }
            }

        if( $sort && $sort != '{"key":null,"dir":null}' )
        {
            $sort_json = json_decode($sort,true) ;

            if( $sort_json['key'] && $sort_json['dir'] )
                $query->orderBy( $sort_json['key'] ,$sort_json['dir'] ) ;
        }

        if ( $per_page && $per_page > 1 ) {
            $paginate = intval($per_page) ;
        }


        if ( $is_table )
            return $query->paginate( $paginate ) ;
        else
            return $query->get() ;
    }


}
