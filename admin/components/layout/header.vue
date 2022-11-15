<template>
  <div>

    <!-- Main Header --->
    <div class="header px-1 align-items-stretch bg-white">
      <div class="container-fluid d-flex align-items-stretch justify-content-between">

        <!---Mobile toggle button and Aside container --->
        <div class="d-flex flex-grow-0 align-items-center  ms-n3 me-1" v-click-outside="hideAside" >

          <!--- Aside toggle button ---->
          <div class="btn btn-icon d-lg-none btn-active-light-primary" @click="toggleAside">
            <Icon
              name="toggle"
              color="nothing"
              size="2x"
              _class="mt-1"
            />
          </div>

          <!--- Aside ---->
          <div class="aside aside-dark aside-hoverable drawer drawer-end w-250px overflow-hidden" :class="{ 'drawer-on' : aside === false }"  >
            <div class="aside-menu flex-column-fluid ">
              <div class="my-5 my-lg-5 ">
                <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"  >

                  <!---Icon --->
                  <div class="row">
                    <div class="col-4 d-flex align-items-center justify-content-center">
                        <AdminAvatar w="60" h="60" />
                    </div>
                    <div class="col d-flex flex-column justify-content-center align-items-start">
                      <span class="text-white py-1 mt-2">{{ $auth.getModel().first_name }} {{ $auth.getModel().last_name }}</span>
                      <span class="text-white py-1">{{ $auth.getModel().username }}</span>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="separator my-5"></div>
                  </div>

                  <div class="col-12" style="max-height: 85vh ; overflow: auto">

                    <AsideSingleItem
                      _icon="dashboard"
                      _title="میز کار"
                      _to="/"
                    />

                    <AsideSingleItem
                      _icon="list"
                      _title="غذاها"
                      _to="/meals"
                    />

                    <AsideSingleItem
                      _icon="cube"
                      _title="محصولات"
                      _to="/products"
                    />

                    <AsideSingleItem
                      _icon="users"
                      _title="کاربران"
                      _to="/users"
                    />

                    <AsideSingleItem
                      _icon="user"
                      _title="پروفایل"
                      _to="/profile"
                    />

                    <AsideSingleItem
                      _icon="logout"
                      _title="خروج"
                      _to="/auth/logout"
                    />

                  </div>

                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>
</template>
<script>
export default {

  name : "LayoutHeader" ,

  data(){
    return {
      aside : false ,
    }
  },

  methods : {

    // Aside
    hideAside(){
      if( window.innerWidth < 991 )
        this.aside = true ;
      else
        this.aside = false ;
    },

    toggleAside(){
      this.aside = !this.aside ;
    },

  },

  created() {
    this.hideAside()
    window.onresize = () => {
      this.hideAside()
    };
  } ,


}
</script>
<style>
.user-dropdown-toggle {
  position: fixed ;
  z-index: 10 ;
  transform: translate(-53px, -5px);
}
.account-dropdown-toggle {
  position: fixed ;
  z-index: 10 ;
  transform: translate(0, 0);
}
</style>
