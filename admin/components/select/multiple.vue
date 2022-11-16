<template>
  <div class="fv-row" :class="{ 'mb-6' : !_sm , 'mb-3' : _sm }">
    <label class="form-label fw-bold label-select text-dark " :class="{ 'fs-8' : _sm,'fs-6' : !_sm  }">{{ _label }}</label>
    <multiselect
      :close-on-select="false"
      :clear-on-select="false"
      :multiple="true"
      :disabled="_disabled"
      :searchable="_searchable"
      :show-labels="false"
      :value="local_value"
      @input="updateVal"
      label="name"
      search="test"
      :placeholder="_placeholder"
      :options="_options"
      track-by="id"
    >
      <template slot="singleLabel" slot-scope="{ option }"> {{ option.name }} </template>
      <span slot="noResult">رکوردی یافت نشد!</span>
    </multiselect>
    <p v-if="error_message" class="pt-2 px-1 text-danger">{{ error_message }}</p>
  </div>
</template>
<script>
export default {

  name : "SelectMultiple",

  props : {

    _disabled : {
      type : Boolean ,
      default : false
    },

    _sm : {
      type : Boolean ,
      default : false
    },

    updateHook : {
      type : Function ,
      default : () => {}
    },
    _label : {
      type : String ,
      default : "Label"
    },
    _options : {
      type : Array ,
      default : () => []
    },
    _searchable : {
      type : Boolean ,
      default : false
    },
    _placeholder : {
      type : String ,
      default : "Select an option"
    },

    _required : {
      type : Boolean ,
      default : false
    },
    errorHook : {
      type : Function ,
      default : () => {}
    },
    _default_value : {
      type : Array ,
      default : () => { return [] }
    },
    _initial_update : {
      type : Boolean ,
      default : true
    },
  },

  mounted() {
    this.local_value = this._default_value
    if( this._initial_update )
      this.updateHook(this._default_value);
  },

  data(){
    return {
      local_value : "",
      error_message : ""
    }
  },

  methods : {

    updateVal( value ){
      this.updateHook(value);
      this.local_value = value ;
    },

  }

}
</script>
<style>

.multiselect{
  cursor: pointer;
}

.multiselect--disabled .multiselect__current, .multiselect--disabled .multiselect__select {
  background: none !important;
}
.multiselect--disabled {
  background: none !important;
  cursor: not-allowed !important;
}

.multiselect__tags{
  border : none ;
  background: #F5F8FA;
}

.multiselect__single{
  background: #F5F8FA;
}

.multiselect__option--highlight {
  background: #F5F8FA;
  outline: none;
  color: #3b3b3b
}

.multiselect__option--highlight:hover {
  background: #F5F8FA;
}


.multiselect__option--selected.multiselect__option--highlight {
  background: #F5F8FA;
  color: #3b3b3b
}
.multiselect__option--selected.multiselect__option--highlight:hover {
  background: #F5F8FA;
}

.multiselect__option--selected.multiselect__option--highlight:after {
  background: #F5F8FA;
  content: attr(data-deselect);
  color: #3b3b3b
}

.multiselect__option--group-selected.multiselect__option--highlight {
  background: #F5F8FA;
  color: #3b3b3b
}
.multiselect__option--group-selected.multiselect__option--highlight:hover {
  background: #F5F8FA;
}

.multiselect__option--group-selected.multiselect__option--highlight:after {
  background: #F5F8FA;
  content: attr(data-deselect);
  color: #3b3b3b
}

.multiselect__option.multiselect__option--selected{
  background: #F5F8FA;
  color: #3b3b3b
}
.multiselect__option.multiselect__option--selected:after{
  background: #F5F8FA;
  color: #3b3b3b
}
.multiselect__option.multiselect__option--selected:hover{
  background: #F5F8FA;
  color: #3b3b3b
}
.multiselect, .multiselect__input, .multiselect__single {
  font-size: inherit !important;
}
.multiselect__input {
  background: #F5F8FA;
}
</style>
