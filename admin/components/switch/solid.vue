<template>
  <div class="fv-row " :class="{ 'mb-6' : !_sm , 'mb-3' : _sm }" >
    <label class="form-label fw-bold text-dark " :class="{ 'fs-8' : _sm,'fs-6' : !_sm  }" >{{ _label }}</label>
    <slot />
    <div class="col form-check form-switch form-check-custom">
      <input class="form-check-input" type="checkbox" @input="updateVal" :checked="!!local_value" />
    </div>
  </div>
</template>
<script>
export default {
  name : "SwitchSolid",

  props : {

    _sm : {
      type : Boolean ,
      default : true
    },
    _updateHook : {
      type : Function ,
      default : () => {}
    },
    _label : {
      type : String ,
      default : ""
    },
    _default_value : {
      type : String|Number ,
      default : ""
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
    this._updateHook(!!this._default_value);
  },

  methods : {

    updateVal( event ){
      this._updateHook(event.target.checked);
      this.local_value = event.target.checked ;
    },

    updateValFromOutSide( val ){
      this._updateHook(val);
      this.local_value = val ;
    },

  }

}
</script>
