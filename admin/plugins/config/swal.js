export default function ( { $swal } ,inject ) {

  inject('swal_success',() => {
    return $swal({
      icon : "success" ,
      title : "Success" ,
      text : "Operation was successfully done!"
    })
  })

  inject('swal_error',(error) => {
    return $swal({
      icon : "error" ,
      title : "Error" ,
      text : error
    })
  })

}
