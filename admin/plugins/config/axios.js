export default function ({ app, redirect, $axios ,$auth }) {

  // Do not run on server
  if (process.server) {
    return
  }

  $axios.onRequest((config) => {
    config.headers = {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Authorization': $auth.getToken() ?? "",
    }
  })

  $axios.interceptors.response.use(
    // on success
    function (response) {
      return response;
    },
    // on error
    function ( error ) {
      const data = error.response?.data
      switch ( error.response.status ) {
        case 422 :
          const errors = error.response.data.errors
          const error_keys = Object.keys(errors)
          const first_error_message = errors[error_keys[0]][0]
          app.$swal({
            icon: "error",
            title: "Error",
            text: first_error_message,
          });
        break
        case 500 :
          app.$swal({
            icon: "error",
            title: "Error",
            text: "Server error, please try again later!",
          });
        break
        case 400 :
        case 470 :
        case 480 :
        case 570 :
          app.$swal({
            icon: "error",
            title: "Error",
            text: data.message,
          });
        break
        case 401 :
          redirect('/auth/logout')
        break
      }
      return Promise.reject(error);
    }
  );


}
