import Vue from 'vue'

import VuePersianDatetimePicker from 'vue-persian-datetime-picker';

Vue.use(VuePersianDatetimePicker, {
  name: 'DatePicker',
  props: {
    format: 'YYYY-MM-DD',
    displayFormat: 'jYYYY-jMM-jDD',
    clearable: true,
    simple: true ,
    type: "date"
  }
})
