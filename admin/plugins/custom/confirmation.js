export default ({ app ,$swal  }, inject) => {

  const confirmation = function({
    confirmed_then = () => {} ,
    reject_then = () => {},
    finally_then = () => {},
  }){

    $swal({
      icon : "question" ,
      title : "تائیدیه" ,
      text : "آیا مطمعن هستید!؟",
      showCancelButton : true ,
      confirmButtonText: 'بله, ادامه بده!',
      cancelButtonText: 'انصراف',
      timer : false ,
      timerProgressBar: false,
      buttonsStyling: false,
      customClass: {
        confirmButton: "btn btn-light-primary btn-sm mx-1 font-weight-bold fs-7",
        denyButton: "btn btn-light-info btn-sm mx-1 font-weight-bold fs-7",
        cancelButton: "btn btn-light-warning btn-sm mx-1 font-weight-bold fs-7",
      }
    })
      .then( result => {
        if( result.isConfirmed || result.isDenied )
        {
          confirmed_then()
          finally_then()
        }
        else
        {
          reject_then()
          finally_then()
        }
      })

  }
  inject('confirmation', confirmation)
}
