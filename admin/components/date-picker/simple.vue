<template>
  <div class="fv-row mb-6">
    <label class="form-label fw-bold text-dark fs-6">{{ _label }}</label>
    <DatePicker
      :placeholder="_placeholder"
      v-model="local_value"
      input-class="form-control form-control-solid fs-7 py-1"
    />
    <p v-if="error_message" class="pt-2 px-1 text-danger">{{ error_message }}</p>
  </div>
</template>
<script>
export default {

  name: "DatePickerSimple",

  props: {
    _label: {
      type: String,
      default: ""
    },
    _placeholder: {
      type: String,
      default: ""
    },
    _required: {
      type: Boolean,
      default: false,
    },
    _updateHook: {
      type: Function,
      default: () => {
      }
    },
    _errorHook: {
      type: Function,
      default: () => {
      }
    },
    _default_value: {
      type: String,
      default: ""
    },
  },

  data() {
    return {
      local_value: "",
      error_message: "",
    }
  },

  mounted() {
    if (this._default_value !== "")
      this.local_value = this._default_value
  },

  methods: {

    updateVal(value) {
      this._updateHook(this.convertDate(value));
      this.local_value = value;
      this.validateValue()
    },

    validateValue() {

      this.error_message = "";

      if (this._required === false)
        return 0;

      if (!this.local_value) {
        this.error_message = this._label + " is required"
      }

      this.errorHook(this.error_message);

      return this.error_message;
    },

    convertDate(date) {
      if (date)
        return new Date(date).toLocaleString('en-ZA', {year: 'numeric', month: 'numeric', day: 'numeric'})
      else
        return ""
    }

  },

  watch: {
    local_value: function (newVal, oldVal) {
      this.updateVal(newVal);
    }
  }

}
</script>
<style>

.cursor-pointer {
  cursor: pointer !important;
}

.mx-datepicker {
  display: block !important;
  width: 100% !important;
}
</style>
