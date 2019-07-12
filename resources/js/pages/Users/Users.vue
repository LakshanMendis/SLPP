<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>Users</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Master - <span class="fw-semi-bold">Users</span>
    </h1>

    <b-row>
      <b-col lg="12">
        <Widget>
        <b-form id="formPersonal" @submit.stop.prevent="submitPersonal()">
          <b-row>
                  <b-col md="3 p-5 bg-dark" id="image-container" class="image-overlay mb-3 ml-4 mr-5">
                    <b-row>
                      <b-col md="12" class="pb-1 pl-4 pr-4">
                        <b-img v-if="!profile_img.url" id="image-preview" class="prof_img" thumbnail fluid :src="require('../../assets/avatar.png')" alt="Default Image"></b-img>
                        <img v-if="profile_img.url" id="image-preview-raw" class="prof_img_raw" :src="profile_img.url" alt="Profile Image" />
                      </b-col>
                    </b-row>

                    <b-row>
                      <b-col md="12">
                        <b-progress v-if="profile_img.upload_progress_show" :value="profile_img.upload_progress_done" :max="profile_img.upload_progress_max" show-progress animated></b-progress>
                        <b-form-file
                          v-if="!profile_img.blocked"
                          id="image-browser"
                          ref="image-browser"
                          placeholder="Choose an image..."
                          drop-placeholder="Drop file here..."
                          :disabled="profile_img.blocked"
                          @change="imageChanged"
                        ></b-form-file>
                      </b-col>
                    </b-row>
                  </b-col>

                  <b-col md="8" class="ml-4">
                    <b-row>
                      <b-col md="6">
                        <b-form-group id="input-group-1" label="*Employee No:" label-for="input-1">
                          <b-form-input
                            id="input-1"
                            required
                            value=""
                            placeholder="Enter Employee No"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-2" label="*EPF No:" label-for="input-2">
                          <b-form-input
                            id="input-2"
                            required
                            value=""
                            placeholder="Enter EPF No"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-3" label="*First Name:" label-for="input-3">
                          <b-form-input
                            id="input-3"
                            required
                            value=""
                            placeholder="Enter First Name"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-4" label="*Last Name:" label-for="input-4">
                          <b-form-input
                            id="input-4"
                            required
                            value=""
                            placeholder="Enter Last Name"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-5" label="Gender:" label-for="input-5">
                          <b-form-select class="mb-3" id="input-5">
                            <option value="" selected disabled>Select Gender</option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-6" label="*Date of Birth:" label-for="input-6">
                          <b-form-input
                           type="date"
                            id="input-6"
                            required
                            placeholder="Date of Birth"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-12" label="*Mobile No:" label-for="input-12">
                          <b-form-input
                            id="input-12"
                            required
                            placeholder="Enter Mobile No"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-13" label="*Email:" label-for="input-13">
                          <b-form-input
                            id="input-13"
                            required
                            placeholder="Enter Email Address"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                    </b-row>
                  </b-col>

                  <b-col md="12">
                    <b-row>
                       <b-col md="4">
                        <b-form-group id="input-group-7" label="*NIC:" label-for="input-7">
                          <b-form-input
                            id="input-7"
                            required
                            placeholder="NIC"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-8" label="Responsible District:" label-for="input-8">
                          <b-form-select class="mb-3" id="input-8">
                            <option value="1" selected disabled>Select Responsibale District</option>
                            <option
                              v-for="data in nationalities"
                              :value="data.id"
                              :key="data.id"
                            >{{ data.short_name + "/" + data.full_name}}</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-9" label="Location:" label-for="input-9">
                          <b-form-select class="mb-3" id="input-9">
                            <option value="1" selected disabled>Select Location</option>
                            <option
                              v-for="data in locations"
                              :value="data.id"
                              :key="data.id"
                            >{{ data.location }}</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-10" label="Department:" label-for="input-10">
                          <b-form-select class="mb-3" id="input-10">
                            <option value="1" selected disabled>Select Department</option>
                            <option
                              v-for="data in departments"
                              :value="data.id"
                              :key="data.id"
                            >{{ data.department }}</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-11" label="Designation:" label-for="input-11">
                          <b-form-select class="mb-3" id="input-11">
                            <option value="1" selected disabled>Select Designation</option>
                            <option
                              v-for="data in designations"
                              :value="data.id"
                              :key="data.id"
                            >{{ data.designations }}</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <!-- <b-col md="4">
                        <b-form-group id="input-group-12" label="*Mobile No:" label-for="input-12">
                          <b-form-input
                            id="input-12"
                            required
                            placeholder="Enter Mobile No"
                          ></b-form-input>
                        </b-form-group>
                      </b-col> -->

                      <!-- <b-col md="4">
                        <b-form-group id="input-group-13" label="*Email:" label-for="input-13">
                          <b-form-input
                            id="input-13"
                            required
                            placeholder="Enter Email Address"
                          ></b-form-input>
                        </b-form-group>
                      </b-col> -->

                      <!-- <b-col md="4">
                        <b-form-group id="input-group-14" label="Immediate:" label-for="input-14">
                          <b-form-select class="mb-3" id="input-14">
                            <option value="1" selected disabled>Select Immediate</option>
                            <option></option>
                          </b-form-select>
                        </b-form-group>
                      </b-col> -->

                      <!-- <b-col md="4">
                        <b-form-group id="input-group-15" label="Department Head:" label-for="input-15">
                          <b-form-select class="mb-3" id="input-15">
                            <option value="1" selected disabled>Select Department Head</option>
                            <option></option>
                          </b-form-select>
                        </b-form-group>
                      </b-col> -->

                      <!-- <b-col md="4">
                        <b-form-group id="input-group-16" label="Higher:" label-for="input-16">
                          <b-form-select class="mb-3" id="input-16">
                            <option value="1" selected disabled>Select Higher</option>
                            <option></option>
                          </b-form-select>
                        </b-form-group>
                      </b-col> -->

                      <!-- <b-col md="4">
                        <b-form-group id="input-group-17" label="Alternate 1:" label-for="input-17">
                          <b-form-select class="mb-3" id="input-17">
                            <option value="1" selected disabled>Select Alternate 1</option>
                            <option></option>
                          </b-form-select>
                        </b-form-group>
                      </b-col> -->

                      <!-- <b-col md="4">
                        <b-form-group id="input-group-18" label="Alternate 2:" label-for="input-18">
                          <b-form-select class="mb-3" id="input-18">
                            <option value="" selected disabled>Select Alternate 2</option>
                            <option></option>
                          </b-form-select>
                        </b-form-group>
                      </b-col> -->

                      <b-col md="4">
                        <b-form-group id="input-group-21" label="Status:" label-for="input-21">
                          <b-form-select class="mb-3" id="input-21" value="1">
                            <option value="" selected disabled>Select Status</option>
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      

                      <b-col md="4">
                        <b-form-group id="input-group-19" label="Joined At:" label-for="input-19">
                          <b-form-input
                           type="date"
                            id="input-19"
                            required>
                            </b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-20" label="Left At:" label-for="input-20">
                          <b-form-input
                           type="date"
                            id="input-20"
                            required>
                            </b-form-input>
                        </b-form-group>
                      </b-col>

                      

                    </b-row>
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

<style src="./../../../../node_modules/vue-multiselect/dist/vue-multiselect.min.css"></style>

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
    all_languages() {
      window.axios.get('/api/languages').then(({ data }) => {
        this.languages = data;
      });
    },
    get_categories() {
      window.axios.get('/api/categories').then(({ data }) => {
        this.categories = data;

        this.category_loaded = true;
      });
    },
    get_category_values() {
      const member_id = this.global_member_id;
      const para = { 'member_id': member_id };

      window.axios.get('/api/categories/values', { params: para }).then(({ data }) => {
        this.category_values = data;

        if (!this.category_loaded) {
          this.category_init_values = data;
          this.get_categories();
        }
      });
    },
    show_why_disabled(){
      if (this.tabs.childTabsDisabled){
        alert ('Please fill basic/personal details first or search and select existing member to edit!!');
      }
    },
    resetAll(){
      this.search.select_member = "";
      this.global_member_id = 0;
      this.tabs.childTabsDisabled = true;

      if (!this.profile_img.blocked) this.$refs['image-browser'].reset();
      this.profile_img.blocked = true;
      this.profile_img.url = null;

      this.$v.$reset();

    },
    
    updateAll() {
      console.log("form ready to submit for update changes, no validation errors!!");

      if (this.global_member_id > 0){
        this.$v.form_personal.$touch();

        if (this.$v.form_personal.$anyError) {
          console.error("Form submit validate errors on personal form");
          this.$swal('Validation Error', 'Please check personal form for validation errors!', 'error');
          return
        }

        this.saveCategories();

        this.form_language.text_pref_name = (this.form_language.text_pref_name == "") ? this.form_personal.text_firstname + " " + this.form_personal.text_lastname : this.form_language.text_pref_name;
        this.form_language.text_pref_address_line1 = (this.form_language.text_pref_address_line1 == "") ? this.form_communication.text_address_line1 : this.form_language.text_pref_address_line1;
        this.form_language.text_pref_address_line2 = (this.form_language.text_pref_address_line2 == "") ? this.form_communication.text_address_line2 : this.form_language.text_pref_address_line2;
        this.form_language.text_pref_city = (this.form_language.text_pref_city == "") ? this.form_communication.text_city : this.form_language.text_pref_city;

        let form_all = {};

        form_all = $.extend(form_all, this.form_personal);
        form_all = $.extend(form_all, this.form_electoral);
        form_all = $.extend(form_all, this.form_communication);
        form_all = $.extend(form_all, this.form_language);

        window.axios.put('/api/members/' + this.global_member_id, form_all).then(({ data }) => {
          this.$swal('Success', 'Member updated successfully!!', 'success');
        });
      }else{
        this.$swal('Error', 'Either you must enter and save personal data first, or select a member from search to update!', 'error');
      }
    },
    submitPersonal() {
      this.$v.form_personal.$touch();

      if (this.$v.form_personal.$anyError) {
        console.error("Form submit validate errors on personal form");
        return
      }

      console.log("personal form ready to submit, no validation errors!!");

      if (this.global_member_id > 0) {
        this.updateAll();
      }else{
        window.axios.get('/api/members/create', { params: this.form_personal }).then(({ data }) => {
          if (data.id) {
            this.global_member_id = data.id;
            this.$swal('Success', 'Member created successfully!!', 'success');
            this.tabs.childTabsDisabled = false;
            this.profile_img.blocked = false;
          }
        });
      }
    },
    
    selectedMember (selectedOption) {
      this.search.select_member = selectedOption;
      this.global_member_id = this.search.select_member.id;
      this.tabs.childTabsDisabled = false;
      this.profile_img.blocked = false;

      setTimeout(() => {
        if (!this.profile_img.blocked) this.$refs['image-browser'].reset();
      }, 500);

      if (this.search.select_member.image_path != null && this.search.select_member.image_path != "") {
        this.profile_img.url = this.search.select_member.image_path;
      }else{
        this.profile_img.url = null;
      }

      this.form_personal.text_membership_id = this.search.select_member.membership_id;
      this.form_personal.select_title = this.search.select_member.title_id;
      this.form_personal.text_firstname = this.search.select_member.firstname;
      this.form_personal.text_lastname = this.search.select_member.lastname;
      this.form_personal.text_callingname = this.search.select_member.callingname;
      this.form_personal.text_nic = this.search.select_member.nic;
      this.form_personal.select_nationality = this.search.select_member.nationality_id;
      this.form_personal.select_religion = this.search.select_member.religion_id;
      this.form_personal.text_remarks = this.search.select_member.remarks;
      this.form_personal.select_status = this.search.select_member.status;

      this.all_districts(this.search.select_member.province_id);
      this.all_electorates(this.search.select_member.province_id);
      this.all_local_auths(this.search.select_member.district_id);
      this.all_wards(this.search.select_member.local_auth_id);
      this.all_gndivs(this.search.select_member.ward_id);

      this.form_electoral.select_province = this.search.select_member.province_id;
      this.form_electoral.select_district = this.search.select_member.district_id;
      this.form_electoral.select_electorate = this.search.select_member.electorate_id;
      this.form_electoral.select_local_auth = this.search.select_member.local_auth_id;
      this.form_electoral.select_ward = this.search.select_member.ward_id;
      this.form_electoral.select_gn = this.search.select_member.gn_id;

      this.form_communication.text_address_line1 = this.search.select_member.address_line1;
      this.form_communication.text_address_line2 = this.search.select_member.address_line2;
      this.form_communication.text_city = this.search.select_member.city;
      this.form_communication.text_postalcode = this.search.select_member.postal_code;
      this.form_communication.text_mobile1 = this.search.select_member.mobile1;
      this.form_communication.text_mobile2 = this.search.select_member.mobile2;
      this.form_communication.text_home_tel = this.search.select_member.home_phone;
      this.form_communication.text_office_tel = this.search.select_member.office_phone;
      this.form_communication.text_fax = this.search.select_member.fax;
      this.form_communication.text_email = this.search.select_member.email;

      this.get_category_values();

      this.form_language.select_pref_lang = this.search.select_member.pref_lang_id;
      this.form_language.text_pref_name = this.search.select_member.pref_lang_name;
      this.form_language.text_pref_address_line1 = this.search.select_member.pref_lang_address_line1;
      this.form_language.text_pref_address_line2 = this.search.select_member.pref_lang_address_line2;
      this.form_language.text_pref_city = this.search.select_member.pref_lang_city;
    },
    imageChanged (e) {
      this.profile_img.image = e.target.files[0];
      const member_id = this.global_member_id;
      this.profile_img.upload_progress_show = true;

      const config = {
        headers: { 
          'content-type': 'multipart/form-data',
          'X-CSRF-TOKEN': token.csrf
        },
        onUploadProgress: uploadEvent => {
          this.profile_img.upload_progress_done = Math.round(uploadEvent.loaded / uploadEvent.total * 100);
        }
      }

      let formData = new FormData();
      formData.append('image', this.profile_img.image);
      formData.append('member_id', member_id);

      window.axios.post('/api/members/image/upload', formData, config).then(({ data }) => {
        this.profile_img.upload_progress_show = false;
        this.profile_img.url = data.url;
      }).catch((e) => {
        this.profile_img.upload_progress_show = false;
        this.$swal('Upload Failed!', 'Please check the image file size and type', 'error');
      });
    }
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
