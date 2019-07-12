<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>Modules</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Master - <span class="fw-semi-bold">Modules</span>
    </h1>

    <b-row>
      <b-col lg="12">
        <Widget>

        <b-form id="formPersonal" @submit.stop.prevent="submitPersonal()">
        <b-row>
                      <b-col md="6">
                        <b-form-group id="input-group-1" label="Code:" label-for="input-1">
                          <b-form-input
                            id="input-1"
                            required
                            value=""
                            placeholder="Enter Code"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-2" label="*Name:" label-for="input-2">
                          <b-form-input
                            id="input-2"
                            required
                            value=""
                            placeholder="Enter Name"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-3" label="Url:" label-for="input-3">
                          <b-form-input
                            id="input-3"
                            required
                            value=""
                            placeholder="Enter url"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-4" label="Internal menu Url:" label-for="input-4">
                          <b-form-input
                            id="input-4"
                            required
                            value=""
                            placeholder="Enter internal menu url"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-5" label="Icon:" label-for="input-5">
                          <b-form-input
                            id="input-5"
                            required
                            value=""
                            placeholder="Select Icon"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-6" label="Main Module:" label-for="input-6">
                          <b-form-select class="mb-3" id="input-4">
                            <option value="" selected disabled>Select Main Module</option>
                            <option value="female">Module 1</option>
                            <option value="male">Module 2</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-7" label="Parent Module Code:" label-for="input-7">
                          <b-form-select class="mb-3" id="input-7">
                            <option value="" selected disabled>Select Parent Module</option>
                            <option value="female">Module 1</option>
                            <option value="male">Module 2</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                     <!-- <b-col md="6">
                        <b-form-group id="input-group-8" label="Is in menu:" label-for="input-8">
                          <b-form-select class="mb-3" id="input-8">
                            <option value="" selected disabled>Select</option>
                            <option value="female">menu 1</option>
                            <option value="male">menu 2</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col> -->

                      <b-col md="6">
                        <b-form-group id="input-group-9" label="Menu Level:" label-for="input-9">
                          <b-form-select class="mb-3" id="input-9">
                            <option value="" selected disabled>Select Menu Level</option>
                            <option value="female">Level 1</option>
                            <option value="male">Level 2</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-10" label="Status:" label-for="input-10">
                          <b-form-select class="mb-3" id="input-10">
                            <option value="" selected disabled>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                      <b-form-group label=" ">
                      <b-form-checkbox-group
                        switches
                        stacked
                        id="media_group"
                        name="media_group"
                        v-model="selected_media"
                        :options="media_options"
                        @input="media_changed"
                      ></b-form-checkbox-group>
                    </b-form-group>

                    
                    <b-form-group id="group_sms">
                      <b-form-select
                        class="mb-1 mt-1"
                        id="sms_option"
                        name="sms_option"
                        :disabled="sms_option_disabled"
                        v-model="selected_sms_sender"
                      >
                        <option :value="[]" disabled>Select Openable</option>
                        <option
                          v-for="data in sms_senders"
                          :value="data"
                          :key="data.id"
                        >{{ data.name + " [" + data.sender_id + "]" }}</option>
                      </b-form-select>
                    </b-form-group>
                    </b-col>
                      
                      
                      <b-col md="3">
                      <b-form-checkbox
                        id="checkbox-1"
                        v-model="status"
                        name="checkbox-1"
                        value="accepted"
                        unchecked-value="not_accepted"
                      >
                        Openable
                      </b-form-checkbox>
                      </b-col>

                      <b-col md="3">
                      <b-form-checkbox
                        id="checkbox-2"
                        v-model="status"
                        name="checkbox-2"
                        value="accepted"
                        unchecked-value="not_accepted"
                      >
                        Is in Menu
                      </b-form-checkbox>
                      </b-col>

                      

        </b-row>
        </b-form>
        <div class="mt-4 clearfix">
            <div class="float-right">
              <b-button variant="maroon" size="md"><i class="fa fa-check"></i> Save</b-button>
            </div>
            <div class="float-left">
              <b-button variant="warning" size="md"><i class="fa fa-plus"></i> New</b-button>
            </div>
          </div>
        </Widget>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import Widget from 'RESO/js/components/Widget/Widget';
import Category from 'RESO/js/components/Category/Category';
import Multiselect from 'vue-multiselect';
import {FormWizard, TabContent} from 'vue-form-wizard';
import 'vue-form-wizard/dist/vue-form-wizard.min.css';

export default {
  name: 'AnotherPage',
  components: { 
    Widget,
    Category,
    Multiselect,
    FormWizard,
    TabContent
  },
  data() {
    return {
      selected_media: [],
      media_options: [
        { text: 'Openable', value: 'SMS' },
        // { text: 'E-mail', value: 'EMAIL' },
        // { text: 'Printed', value: 'PRINT' },
      ],
      sms_option_disabled: true,
      selected_sms_sender: [],
      
      sms_senders: [],
     
      search: {
        select_member: '',
        load_members: [],
        loading: false
      },
      
    }
  },
  methods: {
    media_changed () {
      const has_sms = this.selected_media.includes("SMS");
      
      this.sms_option_disabled = !has_sms;
      
    },
    all_sms_senders() {
      window.axios.get('/api/sms_senders').then(({ data }) => {
        this.sms_senders = data;
      });
    },
    
   
    
    
    
    
    
    finished () {
      let para = {};
      let category_values = {
        categories: this.category_values
      };
      let mode_type = {
        mode: this.target_type
      };

      if (this.target_type == "multiple") {
        para = $.extend(para, this.form_electoral);
        para = $.extend(para, category_values);
        para = $.extend(para, this.template_selection);
        para = $.extend(para, mode_type);
      }else{
        para = {
          member_id: this.search.select_member.id
        }

        para = $.extend(para, this.template_selection);
      }

      this.selected_media.forEach(el => {
        switch (el) {
          case 'SMS':
            window.axios.get('/api/posts/sms', { params: para }).then(({ data }) => {
              console.log(data);
            });
          break;
          
          case 'PRINT':
            window.axios({
              url: '/api/posts/print',
              method: 'post',
              data: para,
              headers: {'X-CSRF-TOKEN': token.csrf},
              responseType: 'blob'
            }).then(({ data }) => {
              const blob = new Blob([data]);
              const url = window.URL.createObjectURL(blob);
              const link = document.createElement('a');
              link.href = url;
              link.download = 'print.pdf';
              document.body.appendChild(link);
              link.click();
              link.remove();
              window.URL.revokeObjectURL(url);
            });
          break;

          case 'EMAIL':
            window.axios.get('/api/posts/email', { params: para }).then(({ data }) => {
              console.log(data);
            });
          break;
        }
      });
    }
  },
  created() {
    this.all_languages();
    this.all_sms_senders();
    this.all_email_senders();
    this.all_locations();
    this.all_provinces();
    this.get_category_values();
    this.all_active_templates();
    this.get_member_count ();
  }
};
</script>
