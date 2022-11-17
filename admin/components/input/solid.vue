<template>
  <div class="fv-row " :class="{ 'mb-6' : !_sm , 'mb-3' : _sm }" >
    <label class="form-label fw-bold text-dark " :class="{ 'fs-8' : _sm,'fs-6' : !_sm  }" >{{ _label }}</label>
    <slot />
    <input :type="_type" :disabled="_disabled" class="form-control form-control-solid" :class="{ 'form-control-sm' : _sm }" @input="updateVal" :value="local_value"  :placeholder="_placeholder" />
    <p v-if="error_message" class="pt-2 px-1 text-danger">{{ error_message }}</p>
  </div>
</template>
<script>
export default {
  name : "InputSolid",

  props : {

    _sm : {
      type : Boolean ,
      default : true
    },

    updateHook : {
      type : Function ,
      default : () => {}
    },
    _type : {
      type : String ,
      default : "text"
    },
    _label : {
      type : String ,
      default : "Label"
    },
    _placeholder : {
      type : String ,
      default : ""
    },
    errorHook : {
      type : Function ,
      default : () => {}
    },
    _validations : {
      type : Array ,
      default : () => []
    },
    _default_value : {
      type : String|Number ,
      default : ""
    },
    _disabled : {
      type : Boolean ,
      default : false
    },
    _initial_update : {
      type : Boolean ,
      default : true
    },
  },

  data(){
    return {
      local_value : "",
      error_message : ""
    }
  },

  mounted() {
    this.local_value = this._default_value
    if( this._initial_update )
      this.updateHook(this._default_value);
  },

  methods : {

    validateEmail(email){
      const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
    },

    updateVal( event ){
      this.updateHook(event.target.value);
      this.local_value = event.target.value ;
      this.validateValue();
    },

    updateValFromOutSide( val ){
      this.updateHook(val);
      this.local_value = val ;
    },

    validateValue(){

      this.error_message = "" ;

      for ( const validation of this._validations ) {

        switch ( validation )
        {
          case "required" :
            if( this.local_value.length === 0 )
            {
              this.error_message = this._label + " is required"
              this.errorHook(this.error_message) ;
              return this.error_message ;
            }
            break ;
          case "min:8" :
            if( this.local_value.length < 8 )
            {
              this.error_message = this._label + " can not be less than 8 character"
              this.errorHook(this.error_message) ;
              return this.error_message ;
            }
            break ;
          case "email" :
            if( this.validateEmail(this.local_value) === false )
            {
              this.error_message = "Invalid email format"
              this.errorHook(this.error_message) ;
              return this.error_message ;
            }
            break ;
          case "numeric" :
            if( ! /^\d+$/.test(this.local_value) )
            {
              this.error_message = "Invalid number format"
              this.errorHook(this.error_message) ;
              return this.error_message ;
            }
            break ;
        }

      }
      this.errorHook(this.error_message) ;
      return this.error_message ;
    }

  }

}
</script>
