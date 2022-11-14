export default function ({ redirect ,$auth }) {

  if( !$auth.getToken() ) {
    return redirect('/auth/login')
  }

}
