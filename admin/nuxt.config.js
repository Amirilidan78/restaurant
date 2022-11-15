export default {
  // Disable server-side rendering: https://go.nuxtjs.dev/ssr-mode
  ssr: false,

  // Target: https://go.nuxtjs.dev/config-target
  target: 'static',

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'admin',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    "~assets/style.bundle.css",
    "~assets/main.css",
  ],



  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    { src: '~plugins/core/auth', mode: 'client' } ,
    { src: '~plugins/config/axios', mode: 'client' } ,
    { src: '~plugins/config/swal', mode: 'client' } ,
    { src: '~plugins/custom/confirmation', mode: 'client' } ,
    { src: '~plugins/custom/click-outside', mode: 'client' } ,
    { src: '~plugins/custom/file', mode: 'client' } ,
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    '@nuxtjs/axios',
    'vue-sweetalert2/nuxt',
    'cookie-universal-nuxt',
  ],

  axios: {
    baseURL: '/api',
    credentials: true,
  },

  sweetalert: {
    icon: 'info',
    timer: 8000,
    timerProgressBar: true,
    width: 400,
    heightAuto: false,
    padding: '2.5rem',
    buttonsStyling: false,
    confirmButtonColor: null,
    cancelButtonColor: null ,
    confirmButtonClass: 'btn mx-1 fw-bold btn-light-primary',
    cancelButtonClass: 'btn mx-1 fw-bold btn-light-warning',
    confirmButtonText : "باشه, متوجه شدم!",
    reverseButtons : true ,
    focusConfirm: true  ,
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  }
}
