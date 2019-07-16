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
          <b-form id="formUser" @submit.stop.prevent="submitUser()" @reset.stop.prevent="resetAll()" novalidate>
            <b-row>
              <b-col md="4" id="image-container" class="mb-3 p-5 bg-dark">
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

              <b-col md="8">
                <b-row>
                  <b-col md="6">
                    <b-form-group id="group_employee_no" label="Employee No:" label-for="employee_no">
                      <b-form-input
                        id="employee_no"
                        value=""
                        placeholder="Enter Employee No"
                        v-model="form_user.employee_no"
                      ></b-form-input>
                    </b-form-group>
                  </b-col>

                  <b-col md="6">
                    <b-form-group id="group_epf_no" label="EPF No:" label-for="epf_no">
                      <b-form-input
                        id="epf_no"
                        value=""
                        placeholder="Enter EPF No"
                        v-model="form_user.epf_no"
                      ></b-form-input>
                    </b-form-group>
                  </b-col>

                  <b-col md="6">
                    <b-form-group id="group_firstname" label="*First Name:" label-for="firstname">
                      <b-form-input
                        id="firstname"
                        value=""
                        placeholder="Enter First Name"
                        v-model="form_user.firstname"
                      ></b-form-input>
                    </b-form-group>
                  </b-col>

                  <b-col md="6">
                    <b-form-group id="group_lastname" label="Last Name:" label-for="lastname">
                      <b-form-input
                        id="lastname"
                        value=""
                        placeholder="Enter Last Name"
                        v-model="form_user.lastname"
                      ></b-form-input>
                    </b-form-group>
                  </b-col>

                  <b-col md="6">
                    <b-form-group id="group_gender" label="Gender:" label-for="gender">
                      <b-form-select class="mb-3" id="gender" v-model="form_user.gender">
                        <option value="" selected disabled>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </b-form-select>
                    </b-form-group>
                  </b-col>

                  <b-col md="6">
                    <b-form-group id="group_dob" label="Date of Birth:" label-for="dob">
                      <b-form-input
                        type="date"
                        id="dob"
                        v-model="form_user.dob"
                      ></b-form-input>
                    </b-form-group>
                  </b-col>

                  <b-col md="6">
                    <b-form-group id="group_mobile" label="Mobile No:" label-for="mobile">
                      <b-form-input
                        id="mobile"
                        placeholder="Enter Mobile No"
                        v-model="form_user.mobile"
                      ></b-form-input>
                    </b-form-group>
                  </b-col>

                  <b-col md="6">
                    <b-form-group id="group_email" label="Email:" label-for="email">
                      <b-form-input
                        id="email"
                        placeholder="Enter Email Address"
                        v-model="form_user.email"
                      ></b-form-input>
                    </b-form-group>
                  </b-col>
                </b-row>
              </b-col>

              <b-col md="12">
                <b-row>
                  <b-col md="4">
                    <b-form-group id="group_nic" label="*NIC:" label-for="nic">
                      <b-form-input
                        id="nic"
                        placeholder="NIC"
                        v-model="form_user.nic"
                      ></b-form-input>
                    </b-form-group>
                  </b-col>

                  <b-col md="4">
                    <b-form-group id="group_districts" label="Responsible District:" label-for="districts">
                      <b-form-select class="mb-3" id="districts" v-model="form_user.districts">
                        <option value="" selected>All</option>
                        <option
                          v-for="data in districts"
                          :value="data.id"
                          :key="data.id"
                        >{{ data.name_en + "/" + data.name_si + "/" + data.name_ta }}</option>
                      </b-form-select>
                    </b-form-group>
                  </b-col>

                  <b-col md="4">
                    <b-form-group id="group_location" label="Location:" label-for="location">
                      <b-form-select class="mb-3" id="location" v-model="form_user.location">
                        <option value="" selected disabled>Select Location</option>
                        <option
                          v-for="data in locations"
                          :value="data.id"
                          :key="data.id"
                        >{{ data.location }}</option>
                      </b-form-select>
                    </b-form-group>
                  </b-col>

                  <b-col md="4">
                    <b-form-group id="group_department" label="Department:" label-for="department">
                      <b-form-select class="mb-3" id="department" v-model="form_user.department">
                        <option value="" selected disabled>Select Department</option>
                        <option
                          v-for="data in departments"
                          :value="data.id"
                          :key="data.id"
                        >{{ data.department }}</option>
                      </b-form-select>
                    </b-form-group>
                  </b-col>

                  <b-col md="4">
                    <b-form-group id="group_designation" label="Designation:" label-for="designation">
                      <b-form-select class="mb-3" id="designation" v-model="form_user.designation">
                        <option value="" selected disabled>Select Designation</option>
                        <option
                          v-for="data in designations"
                          :value="data.id"
                          :key="data.id"
                        >{{ data.designations }}</option>
                      </b-form-select>
                    </b-form-group>
                  </b-col>

                  <b-col md="4">
                    <b-form-group id="group_status" label="Status:" label-for="status">
                      <b-form-select class="mb-3" id="status" v-model="form_user.status">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                      </b-form-select>
                    </b-form-group>
                  </b-col>

                  <b-col md="4">
                    <b-form-group id="group_joined_at" label="Joined At:" label-for="joined_at">
                      <b-form-input
                        type="date"
                        id="joined_at"
                        v-model="form_user.joined_at"
                      >
                      </b-form-input>
                    </b-form-group>
                  </b-col>

                  <b-col md="4">
                    <b-form-group id="group_left_at" label="Left At:" label-for="left_at">
                      <b-form-input
                        type="date"
                        id="left_at"
                        v-model="form_user.left_at"
                      >
                      </b-form-input>
                    </b-form-group>
                  </b-col>

                  <b-col md=4 class="pt-5 text-center">
                    <b-form-checkbox
                      id="system_access"
                      v-model="form_user.system_access"
                      name="system_access"
                      :value="true"
                      :unchecked-value="false"
                    >
                      System Access
                    </b-form-checkbox>
                  </b-col>

                  <b-col md="6" class="mt-3">
                    <b-form-group id="group_username" label="*Username:" label-for="username">
                      <b-form-input
                        id="username"
                        placeholder="Enter Username"
                        v-model="form_user.username"
                        :disabled="!form_user.system_access"
                      ></b-form-input>
                    </b-form-group>
                  </b-col>

                  <b-col md="6" class="mt-3">
                    <b-form-group id="group_password" label="*Password:" label-for="password">
                      <b-form-input
                        id="password"
                        placeholder="Enter Password"
                        type="password"
                        v-model="form_user.password"
                        :disabled="!form_user.system_access"
                      ></b-form-input>
                    </b-form-group>
                  </b-col>
                </b-row>
              </b-col>
            </b-row>

            <div class="mt-4 clearfix">
              <div class="float-right">
                <b-button type="submit" variant="maroon" size="md"><i class="fa fa-check"></i> Save</b-button>
              </div>
              <div class="float-left">
                <b-button type="reset" variant="warning" size="md"><i class="fa fa-plus"></i> New</b-button>
              </div>
            </div>
          </b-form>
        </Widget>
      </b-col>
    </b-row>
  </div>
</template>

<style src="./../../../../node_modules/vue-multiselect/dist/vue-multiselect.min.css"></style>

<script>
import Widget from 'RESO/js/components/Widget/Widget';
import { required } from 'vuelidate/lib/validators';
import Multiselect from 'vue-multiselect';

export default {
  name: 'MemberNew',
  components: { Widget, Multiselect },
  data() {
    return {
      global_user_id: 0,
      districts: [],
      locations: [],
      departments: [],
      designations: [],
      search: {
        select_user: '',
        load_users: [],
        loading: false
      },
      profile_img: {
        blocked: true,
        image: '',
        upload_progress_show: false,
        upload_progress_done: 0,
        upload_progress_max: 100,
        url: null
      },
      form_user: {
        id: this.global_user_id,
        employee_no: '',
        epf_no: '',
        firstname: '',
        lastname: '',
        gender: '',
        dob: '',
        mobile: '',
        email: '',
        nic: '',
        districts: [],
        location: 1,
        department: "",
        designation: "",
        status: 1,
        joined_at: "",
        left_at: "",
        system_access: true,
        username: "",
        password: "",
      },
    }
  },
  /*validations: {
    form_user: {
      firstname: { required },
      nic: { required },
    },
  },*/
  methods: {
    all_districts() {
      window.axios.get('/api/districts').then(({ data }) => {
        this.districts = data;
      });
    },
    all_locations(company_id = 1) {
      if (company_id == "") return;

      const para = { 'company_id': company_id, 'query' : 'all-active' };

      window.axios.get('/api/locations', { params: para }).then(({ data }) => {
        this.locations = data;
      });
    },
    all_departments(location_id = 1) {
      if (location_id == "") return;

      const para = { 'location_id': location_id };

      window.axios.get('/api/departments', { params: para }).then(({ data }) => {
        this.departments = data;
      });
    },
    all_designations() {
      window.axios.get('/api/designations').then(({ data }) => {
        this.designations = data;
      });
    },
    resetAll(){
      this.search.select_user = "";
      this.global_user_id = 0;

      if (!this.profile_img.blocked) this.$refs['image-browser'].reset();
      this.profile_img.blocked = true;
      this.profile_img.url = null;

      this.form_user.employee_no = "";
      this.form_user.epf_no = "";
      this.form_user.firstname = "";
      this.form_user.lastname = "";
      this.form_user.gender = "";
      this.form_user.dob = "";
      this.form_user.mobile = "";
      this.form_user.email = "";
      this.form_user.nic = "";
      this.form_user.districts = [];
      this.form_user.location = 1;
      this.form_user.department = "";
      this.form_user.designation = "";
      this.form_user.status = 1;
      this.form_user.joined_at = "";
      this.form_user.left_at = "";
      this.form_user.system_access = true;
      this.form_user.username = "";
      this.form_user.password = "";

      //this.$v.$reset();
    },
    updateAll() {

    },
    submitUser() {
      /*this.$v.form_user.$touch();

      if (this.$v.form_user.$anyError) {
        console.error("Form submit validate errors on user form");
        return
      }

      console.log("user form ready to submit, no validation errors!!");*/

      if (this.global_user_id > 0) {
        this.updateAll();
      }else{
        window.axios.get('/api/users/create', { params: this.form_user }).then(({ data }) => {
          if (data.id) {
            this.global_user_id = data.id;
            this.profile_img.blocked = false;

            if (this.form_user.system_access) {
              const form_access = {
                user_id: data.id,
                username: this.form_user.username,
                password: this.form_user.password,
              }

              window.axios.get('/api/access/create', { params: form_access }).then(({ data }) => {
                if (data.id) {
                  this.$swal('Success', 'User & access created successfully!!', 'success');
                }
              }).catch((e) => {
                console.error(e);
                this.$swal('Warning', 'User created successfully but access creation failed!!', 'warning');
              });
            } else {
              this.$swal('Success', 'User created successfully!!', 'success');
            }
          }
        }).catch((e) => {
          console.error(e);
          this.$swal('Error', 'User creation failed', 'error');
        });
      }
    },
    selectedUser (selectedOption) {
      this.search.select_user = selectedOption;
      this.global_user_id = this.search.select_user.id;
      this.profile_img.blocked = false;

      setTimeout(() => {
        if (!this.profile_img.blocked) this.$refs['image-browser'].reset();
      }, 500);

      if (this.search.select_member.image_path != null && this.search.select_member.image_path != "") {
        this.profile_img.url = this.search.select_user.image_path;
      }else{
        this.profile_img.url = null;
      }

      /*this.form_personal.text_membership_id = this.search.select_member.membership_id;
      this.form_personal.select_title = this.search.select_member.title_id;
      this.form_personal.text_firstname = this.search.select_member.firstname;
      this.form_personal.text_lastname = this.search.select_member.lastname;
      this.form_personal.text_callingname = this.search.select_member.callingname;
      this.form_personal.text_nic = this.search.select_member.nic;
      this.form_personal.select_nationality = this.search.select_member.nationality_id;
      this.form_personal.select_religion = this.search.select_member.religion_id;
      this.form_personal.text_remarks = this.search.select_member.remarks;
      this.form_personal.select_status = this.search.select_member.status;*/
    },
    imageChanged (e) {
      this.profile_img.image = e.target.files[0];
      const user_id = this.global_user_id;
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
      formData.append('user_id', user_id);

      window.axios.post('/api/users/image/upload', formData, config).then(({ data }) => {
        this.profile_img.upload_progress_show = false;
        this.profile_img.url = data.url;
      }).catch((e) => {
        this.profile_img.upload_progress_show = false;
        this.$swal('Upload Failed!', 'Please check the image file size and type', 'error');
      });
    }
  },
  created() {
    this.all_districts();
    this.all_locations(1);
    this.all_departments(1);
    this.all_designations();
  }
};
</script>
