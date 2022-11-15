export default function ( { $swal } ,inject ) {

  inject('swal_success',() => {
    return $swal({
      icon : "success" ,
      title : "موفقیت" ,
      text : "عملیات با موفقیت انجام شد"
    })
  })

  inject('swal_error',(error) => {
    return $swal({
      icon : "error" ,
      title : "خطا" ,
      text : error
    })
  })

}
