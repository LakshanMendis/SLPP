<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>Typography</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Report - <span class="fw-semi-bold">Member Report</span>
    </h1>

    <b-row>
      <b-col lg="12">
        <Widget>

           <b-tabs content-class="mt-3">
             <b-tab title="Personal" active>
              <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-1" label="Membership ID:" label-for="input-1">
                    <b-form-input
                      id="input-1"
                      placeholder="Member ID"
                    ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group id="input-group-2" label="Name (Like):" label-for="input-2">
                    <b-form-input
                      id="input-2"
                      placeholder="Member name"
                    ></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>

              <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-7" label="Nationality:" label-for="input-7">
                    <b-form-select class="mb-3" id="input-7">
                      
                    </b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group id="input-group-8" label="Religion:" label-for="input-8">
                    <b-form-select class="mb-3" id="input-8">
                      
                    </b-form-select>
                  </b-form-group>
                </b-col>
              </b-row>
            </b-tab>

          <b-tab title="Electoral">
              <b-row>
                <b-col md="12">
                  <b-row>
                    <b-col md="12">
          <b-form name="formElectoral" id="formElectoral" @submit.stop.prevent="updateAll()" @reset.stop.prevent="resetAll()" novalidate>
                <b-row>
                  <b-col md="12">
                    <b-row>
                      <b-col md="6">
                        <b-form-group id="group_province" label="Province:" label-for="select_province">
                          <b-form-select class="mb-3" id="select_province" @change="all_districts($event);all_electorates($event);" v-model="form_electoral.select_province">
                            <option value="1" selected disabled>Select Province</option>
                            <option
                              v-for="data in provinces"
                              :value="data.id"
                              :key="data.id"
                            >{{ data.name_en + "/" + data.name_si + "/" + data.name_ta }}</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="group_district" label="District:" label-for="select_district">
                          <b-form-select class="mb-3" id="select_district" @change="all_local_auths($event);" v-model="form_electoral.select_district">
                            <option value="1" selected disabled>Select District</option>
                            <option
                              v-for="data in districts"
                              :value="data.id"
                              :key="data.id"
                            >{{ data.name_en + "/" + data.name_si + "/" + data.name_ta }}</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>
                    </b-row>

                    <b-row>
                      <b-col md="6">
                        <b-form-group id="group_electorate" label="Electorate:" label-for="select_electorate">
                          <b-form-select class="mb-3" id="select_electorate" v-model="form_electoral.select_electorate">
                            <option value="1" selected disabled>Select Electorate</option>
                            <option
                              v-for="data in electorates"
                              :value="data.id"
                              :key="data.id"
                            >{{ data.name_en + "/" + data.name_si + "/" + data.name_ta }}</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="group_local_auth" label="Local Authority:" label-for="select_local_auth">
                          <b-form-select class="mb-3" id="select_local_auth" @change="all_wards($event);" v-model="form_electoral.select_local_auth">
                            <option value="1" selected disabled>Select Local Authority</option>
                            <option
                              v-for="data in localAuths"
                              :value="data.id"
                              :key="data.id"
                            >{{ data.name_en + "/" + data.name_si + "/" + data.name_ta }}</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>
                    </b-row>

                    <b-row>
                      <b-col md="6">
                        <b-form-group id="group_ward" label="Ward:" label-for="select_ward">
                          <b-form-select class="mb-3" id="select_ward" @change="all_gndivs($event);" v-model="form_electoral.select_ward">
                            <option value="1" selected disabled>Select Ward</option>
                            <option
                              v-for="data in wards"
                              :value="data.id"
                              :key="data.id"
                            >{{ data.name_en + "/" + data.name_si + "/" + data.name_ta }}</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="group_gn" label="GN Division:" label-for="select_gn">
                          <b-form-select class="mb-3" id="select_gn" v-model="form_electoral.select_gn">
                            <option value="1" selected disabled>Select GN Division</option>
                            <option
                              v-for="data in gnDivs"
                              :value="data.id"
                              :key="data.id"
                            >{{ data.name_en + "/" + data.name_si + "/" + data.name_ta }}</option>
                            </b-form-select>
                          </b-form-group>
                        </b-col>
                      </b-row>
                    </b-col>
                  </b-row>
                </b-form>
                </b-col>
              </b-row>
            </b-col>
          </b-row>
          </b-tab>

           <b-tab title="Categories">
              <b-row>
                <b-col md="12">
                  <b-row>
                    <b-col md="12">
                      <b-row>
            <b-col md="12" class="pt-3 pb-2">
              <b-row>
                  <b-col md="4">
                    <b-form-group id="input-group-9" label="Member Type:" label-for="input-9">
                      <b-form-input id="input-9" value="Parliament" disabled></b-form-input>
                    </b-form-group>
                  </b-col>

                  <b-col md="4">
                    <b-form-group id="input-group-10" label="Profession:" label-for="input-10">
                      <b-form-input id="input-10" value="Doctor" disabled></b-form-input>
                    </b-form-group>
                  </b-col>

                  <b-col md="4">
                    <b-form-group id="input-group-11" label="Sub Category:" label-for="input-11">
                      <b-form-input id="input-11" value="N/A" disabled></b-form-input>
                    </b-form-group>
                  </b-col>
                </b-row>
            </b-col>
          </b-row>
                    </b-col>
                  </b-row>
                </b-col>
              </b-row>
           </b-tab>

          
          
           </b-tabs>
           <div class="mt-2 clearfix">
            <div class="float-right">
              <b-button type="submit" variant="maroon" size="md"><i class="fa fa-search"></i> View</b-button>
            </div>
            </div>
        </Widget>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import Widget from 'RESO/js/components/Widget/Widget';
import CategoryMultiple from 'RESO/js/components/CategoryMultiple/CategoryMultiple';
import { required } from 'vuelidate/lib/validators';
import Multiselect from 'vue-multiselect';

export default {
  name: 'MemberNew',
  components: { Widget, Multiselect, CategoryMultiple },
  data() {
    return {
      category_loaded: false,
      categories: [],
      category_values:[],
      category_init_values:[],
      tabs:{
        showHelpAlert: true,
        childTabsDisabled: true
      },
      search: {
        select_member: '',
        load_members: [],
        loading: false
      },
      global_member_id: 0,
      titles: [],
      nationalities: [],
      religions: [],
      provinces: [],
      districts: [],
      electorates: [],
      localAuths: [],
      wards: [],
      gnDivs: [],
      languages: [],
      profile_img: {
        blocked: true,
        image: '',
        upload_progress_show: false,
        upload_progress_done: 0,
        upload_progress_max: 100,
        url: null
      },
      form_personal: {
        id: this.global_member_id,
        text_membership_id: '',
        select_title: '',
        text_firstname: '',
        text_lastname: '',
        text_callingname: '',
        text_nic: '',
        select_nationality: 1,
        select_religion: 1,
        text_remarks: '',
        select_status: 1
      },
      form_electoral: {
        id: this.global_member_id,
        select_province: 1,
        select_district: 1,
        select_electorate: 1,
        select_local_auth: 1,
        select_ward: 1,
        select_gn: 1
      },
      form_communication: {
        id: this.global_member_id,
        text_address_line1: '',
        text_address_line2: '',
        text_city: '',
        text_postalcode: '',
        text_mobile1: '',
        text_mobile2: '',
        text_home_tel: '',
        text_office_tel: '',
        text_fax: '',
        text_email: ''
      },
      form_language: {
        id: this.global_member_id,
        select_pref_lang: 1,
        text_pref_name: "",
        text_pref_address_line1: "",
        text_pref_address_line2: "",
        text_pref_city: ""
      }
    }
  },
  validations: {
    form_personal: {
      text_membership_id: { required },
      text_firstname: { required },
      text_callingname: { required },
      text_nic: { required },
    },
  },
  methods: {
    all_titles() {
      window.axios.get('/api/titles').then(({ data }) => {
        this.titles = data;
      });
    },
    all_nationalities() {
      window.axios.get('/api/nationalities').then(({ data }) => {
        this.nationalities = data;
      });
    },
    all_religions() {
      window.axios.get('/api/religions').then(({ data }) => {
        this.religions = data;
      });
    },
    all_provinces() {
      window.axios.get('/api/provinces').then(({ data }) => {
        this.provinces = data;
      });
    },
    all_districts(province_id = 1) {
      if (province_id == 1) return;

      const para = { 'province_id': province_id };

      window.axios.get('/api/districts', { params: para }).then(({ data }) => {
        this.districts = data;
      });
    },
    all_electorates(province_id = 1) {
      if (province_id == 1) return;

      const para = { 'province_id': province_id };

      window.axios.get('/api/electorates', { params: para }).then(({ data }) => {
        this.electorates = data;
      });
    },
    all_local_auths(district_id = 1) {
      if (district_id == 1) return;

      const para = { 'district_id': district_id };

      window.axios.get('/api/localAuths', { params: para }).then(({ data }) => {
        this.localAuths = data;
      });
    },
    all_wards(local_auth_id = 1) {
      if (local_auth_id == 1) return;

      const para = { 'local_auth_id': local_auth_id };

      window.axios.get('/api/wards', { params: para }).then(({ data }) => {
        this.wards = data;
      });
    },
    all_gndivs(ward_id = 1) {
      if (ward_id == 1) return;

      const para = { 'ward_id': ward_id };

      window.axios.get('/api/gnDivs', { params: para }).then(({ data }) => {
        this.gnDivs = data;
      });
    },
 
    resetAll(){
      this.$v.$reset();

      this.districts = [],
      this.electorates = [],
      this.localAuths = [],
      this.wards = [],
      this.gnDivs = [],

      this.form_electoral.select_province = 1;
      this.form_electoral.select_district = 1;
      this.form_electoral.select_electorate = 1;
      this.form_electoral.select_local_auth = 1;
      this.form_electoral.select_ward = 1;
      this.form_electoral.select_gn = 1;

    },
   
 
  },
  created() {
    this.all_titles();
    this.all_nationalities();
    this.all_religions();
    this.all_provinces();
    this.all_languages();
    this.get_category_values();
  }
};
</script>