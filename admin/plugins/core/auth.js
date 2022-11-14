export default function ({ app },inject) {

  const tokenKey = "jwt_token"
  const modelKey = "jwt_model"
  const authTime = 60 * 60 // 1 hour

  const set = ( key, value ) => app.$cookies.set(key, value, {  path: '/', maxAge: authTime })
  const get = ( key ) => app.$cookies.get(key)
  const unset = ( key ) => app.$cookies.remove(key)

  const getToken = () => get(tokenKey)
  const setToken = (token) => set(tokenKey,token)
  const removeToken = () => unset(tokenKey)

  const getModel = () => getToken(modelKey)
  const setModel = (model) => set(modelKey,model)
  const removeModel = () => unset(modelKey)

  inject('auth',{
    getToken ,
    setToken ,
    removeToken ,
    getModel ,
    setModel ,
    removeModel ,
  })

}
