<template>
    <multiselect
      :searchable="_searchable"
      :close-on-select="true"
      :allow-empty="false"
      :show-labels="false"
      :value="local_value"
      @input="updateVal"
      label="name"
      :disabled="_disabled"
      search="test"
      :placeholder="_placeholder"
      :options="_options">
      <template slot="singleLabel" slot-scope="{ option }"> {{ option.name }} </template>
      <span slot="noResult">رکوردی یافت نشد!</span>
    </multiselect>
</template>
<script>
export default {
  name : "SelectBare",

  props : {

    _disabled : {
      type : Boolean ,
      default : false
    },
    updateHook : {
      type : Function ,
      default : () => {}
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
      default : ""
    },
    errorHook : {
      type : Function ,
      default : () => {}
    },
    _default_value : {
      type : Object ,
      default : () => { return {} }
    },
  },

  mounted() {

    this.local_value = this._default_value

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

      this.validateValue()
    },

    validateValue(){

      this.error_message = "" ;

      if( ! this.local_value )
      {
        this.error_message = this._label + " is required"
      }

      if( this.local_value === {} )
      {
        this.error_message = this._label + " is required"
      }

      if( Object.keys(this.local_value).length === 0 )
      {
        this.error_message = this._label + " is required"
      }

      this.errorHook(this.error_message) ;

      return this.error_message ;

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
