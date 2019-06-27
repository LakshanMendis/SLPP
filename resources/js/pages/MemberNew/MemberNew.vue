<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>New Member</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Member - <span class="fw-semi-bold">Add New</span>
    </h1>

    <b-row>
      <b-col lg="12">
        <Widget>
          <b-tabs content-class="mt-3">
            <b-tab title="Personal" active>
              <b-form id="formPersonal" @submit.stop.prevent="submitPersonal()">
                <b-row>
                  <b-col md="3 p-4 bg-dark">
                    <b-row>
                      <b-col md="12" class="pb-1">
                        <b-img thumbnail fluid src="http://leadership.hscni.net/Images/Uploads/anon_user.png" alt="Image 1"></b-img>
                      </b-col>
                    </b-row>

                    <b-row>
                      <b-col md="12">
                        <b-form-file
                          placeholder="Choose a image..."
                          drop-placeholder="Drop file here..."
                        ></b-form-file>
                      </b-col>
                    </b-row>
                  </b-col>
                  <b-col md="9">
                    <b-row>
                      <b-col md="6">
                        <b-form-group id="input-group-1" label="*Membership ID:" label-for="input-1">
                          <b-form-input
                            id="input-1"
                            required
                            value=""
                            placeholder="Enter Membership ID"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col md="6">
                        <b-form-group id="input-group-2" label="Title:" label-for="input-2">
                          <b-form-select class="mb-3" id="input-2">
                            <option value="" selected disabled>Select Title</option>
                            <option
                              v-for="data in titles"
                              :value="data.id"
                              :key="data.id"
                            >{{ data.name_en + "/" + data.name_si + "/" + data.name_ta }}</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>
                    </b-row>

                    <b-row>
                      <b-col md="6">
                        <b-form-group id="input-group-3" label="*First Name/Initials:" label-for="input-3">
                          <b-form-input
                            id="input-3"
                            required
                            placeholder="First Name/Initials"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col md="6">
                        <b-form-group id="input-group-4" label="Last Name:" label-for="input-4">
                          <b-form-input
                            id="input-4"
                            required
                            placeholder="Last Name"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>

                    <b-row>
                      <b-col md="6">
                        <b-form-group id="input-group-5" label="*Calling Name:" label-for="input-5">
                          <b-form-input
                            id="input-5"
                            required
                            placeholder="Calling Name"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>
                      <b-col md="6">
                        <b-form-group id="input-group-6" label="*NIC:" label-for="input-6">
                          <b-form-input
                            id="input-6"
                            required
                            placeholder="NIC"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>

                    <b-row>
                      <b-col md="6">
                        <b-form-group id="input-group-7" label="Nationality:" label-for="input-7">
                          <b-form-select class="mb-3" id="input-7">
                            <option value="1" selected disabled>Select Nationality</option>
                            <option
                              v-for="data in nationalities"
                              :value="data.id"
                              :key="data.id"
                            >{{ data.name_en + "/" + data.name_si + "/" + data.name_ta }}</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-8" label="Religion:" label-for="input-8">
                          <b-form-select class="mb-3" id="input-8">
                            <option value="1" selected disabled>Select Religion</option>
                            <option
                              v-for="data in religions"
                              :value="data.id"
                              :key="data.id"
                            >{{ data.name_en + "/" + data.name_si + "/" + data.name_ta }}</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>
                    </b-row>
                  </b-col>
                </b-row>

                <b-row>
                  <b-col md="12" class="pt-3 pb-2">
                    <fieldset>
                      <legend><h5><strong>Categories</strong></h5></legend>
                      <b-row>
                        <b-col md="4">
                          <b-form-group id="input-group-9" label="Member Type:" label-for="input-9">
                            <b-form-select class="mb-3" id="input-9">
                              <option value="1">Parliament</option>
                              <option value="2">Provincial</option>
                              <option value="3">Local Authority</option>
                              <option value="4">SLPP Union</option>
                              <option value="5">SLPP Party</option>
                              <option value="6">SLPP Intelectual</option>
                            </b-form-select>
                          </b-form-group>
                        </b-col>

                        <b-col md="4">
                          <b-form-group id="input-group-10" label="Profession:" label-for="input-10">
                            <b-form-select class="mb-3" id="input-10">
                              <option value="1">Administration</option>
                              <option value="2">Driver</option>
                              <option value="3">Engineer</option>
                              <option value="4">Doctor</option>
                              <option value="5">Tour Guide</option>
                              <option value="6">Military Officer</option>
                            </b-form-select>
                          </b-form-group>
                        </b-col>

                        <b-col md="4">
                          <b-form-group id="input-group-11" label="Sub Category:" label-for="input-11">
                            <b-form-select class="mb-3" id="input-11">
                              <option value="1">Sub category 1</option>
                            </b-form-select>
                          </b-form-group>
                        </b-col>
                      </b-row>
                    </fieldset>
                  </b-col>
                </b-row>

                <b-row>
                  <b-col lg="8">
                    <b-form-group id="input-group-12" label="Remarks:" label-for="input-12">
                      <b-form-textarea
                        id="input-12"
                        placeholder="Remarks..."
                        rows="3"
                        max-rows="6"
                      ></b-form-textarea>
                    </b-form-group>
                  </b-col>

                  <b-col lg="4">
                    <b-form-group id="input-group-13" label="*Status:" label-for="input-13">
                      <b-form-select class="mb-3" id="input-13">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </b-form-select>
                    </b-form-group>
                  </b-col>
                </b-row>

                <div class="mt-2 clearfix">
                  <div class="float-right">
                    <b-button type="submit" variant="maroon" size="md"><i class="fa fa-check"></i> Save</b-button>
                  </div>
                  <div class="float-left">
                    <b-button type="reset" variant="warning" size="md"><i class="fa fa-plus"></i> New</b-button>
                  </div>
                </div>
              </b-form>
            </b-tab>

            <b-tab title="Electoral" :disabled="tabs.childTabsDisabled">
              <b-row>
                <b-col md="12">
                  <b-row>
                    <b-col md="6">
                      <b-form-group id="input-group-14" label="Province:" label-for="input-14">
                        <b-form-select class="mb-3" id="input-14" @change="all_districts($event);all_electorates($event);">
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
                      <b-form-group id="input-group-15" label="District:" label-for="input-15">
                        <b-form-select class="mb-3" id="input-14" @change="all_local_auths($event);">
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
                      <b-form-group id="input-group-16" label="Electorate:" label-for="input-16">
                        <b-form-select class="mb-3" id="input-16">
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
                      <b-form-group id="input-group-17" label="Local Authority:" label-for="input-17">
                        <b-form-select class="mb-3" id="input-17" @change="all_wards($event);">
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
                      <b-form-group id="input-group-18" label="Ward:" label-for="input-18">
                        <b-form-select class="mb-3" id="input-18" @change="all_gndivs($event);">
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
                      <b-form-group id="input-group-19" label="GN Division:" label-for="input-19">
                        <b-form-select class="mb-3" id="input-19">
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

              <div class="mt-2 clearfix">
                <div class="float-right">
                  <b-button variant="maroon" size="md"><i class="fa fa-check"></i> Save</b-button>
                </div>
              </div>
            </b-tab>

            <b-tab title="Communication" :disabled="tabs.childTabsDisabled">
              <b-row>
                <b-col md="12">
                  <b-row>
                    <b-col md="6">
                      <b-form-group id="input-group-20" label="Address Line 1:" label-for="input-20">
                        <b-form-input
                          id="input-20"
                          required
                          placeholder="Address Line 1"
                        ></b-form-input>
                      </b-form-group>
                    </b-col>

                    <b-col md="6">
                      <b-form-group id="input-group-21" label="Address Line 2:" label-for="input-21">
                        <b-form-input
                          id="input-21"
                          required
                          placeholder="Address Line 2"
                        ></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>

                  <b-row>
                    <b-col md="6">
                      <b-form-group id="input-group-22" label="City:" label-for="input-22">
                        <b-form-input
                          id="input-22"
                          required
                          placeholder="City"
                        ></b-form-input>
                      </b-form-group>
                    </b-col>

                    <b-col md="6">
                      <b-form-group id="input-group-23" label="Postal Code:" label-for="input-23">
                        <b-form-input
                          id="input-23"
                          required
                          placeholder="Postal Code"
                        ></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>

                  <b-row>
                    <b-col md="6">
                      <b-form-group id="input-group-24" label="Mobile Number 1:" label-for="input-24">
                        <b-form-input
                          id="input-24"
                          required
                          placeholder="Mobile Number 1"
                        ></b-form-input>
                      </b-form-group>
                    </b-col>

                    <b-col md="6">
                      <b-form-group id="input-group-25" label="Mobile Number 2:" label-for="input-25">
                        <b-form-input
                          id="input-25"
                          required
                          placeholder="Mobile Number 2"
                        ></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>

                  <b-row>
                    <b-col md="6">
                      <b-form-group id="input-group-26" label="Home Tel:" label-for="input-26">
                        <b-form-input
                          id="input-26"
                          required
                          placeholder="Home Tel"
                        ></b-form-input>
                      </b-form-group>
                    </b-col>

                    <b-col md="6">
                      <b-form-group id="input-group-27" label="Office Tel:" label-for="input-27">
                        <b-form-input
                          id="input-27"
                          required
                          placeholder="Office Tel"
                        ></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>

                  <b-row>
                    <b-col md="6">
                      <b-form-group id="input-group-28" label="Fax:" label-for="input-28">
                        <b-form-input
                          id="input-28"
                          required
                          placeholder="Fax"
                        ></b-form-input>
                      </b-form-group>
                    </b-col>

                    <b-col md="6">
                      <b-form-group id="input-group-29" label="E-Mail:" label-for="input-29">
                        <b-form-input
                          id="input-29"
                          required
                          placeholder="E-Mail"
                        ></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>
                </b-col>
              </b-row>

              <div class="mt-2 clearfix">
                <div class="float-right">
                  <b-button variant="maroon" size="md"><i class="fa fa-check"></i> Save</b-button>
                </div>
              </div>
            </b-tab>

            <b-tab title="Language" :disabled="tabs.childTabsDisabled">
              <b-row>
                <b-col md="12">
                  <b-row>
                    <b-col md="6">
                      <b-form-group id="input-group-30" label="Preferred Language:" label-for="input-30">
                        <b-form-select class="mb-3" id="input-30">
                          <option value="1" selected disabled>Select Language</option>
                          <option
                            v-for="data in languages"
                            :value="data.id"
                            :key="data.id"
                          >{{ data.language + " - " + data.caption }}</option>
                        </b-form-select>
                      </b-form-group>
                    </b-col>
                  </b-row>

                  <hr />

                  <b-row>
                    <b-col md="12">
                      <p class="muted text-info">Fill following fields using <strong>selected language</strong>, if preferred language selection is <strong>not English</strong>!</p>
                    </b-col>
                  </b-row>

                  <b-row>
                    <b-col md="12">
                      <b-form-group id="input-group-31" label="Name:" label-for="input-31">
                        <b-form-input
                          id="input-31"
                          required
                          placeholder="Enter name with initials"
                        ></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>

                  <b-row>
                    <b-col md="4">
                      <b-form-group id="input-group-32" label="Address Line 1:" label-for="input-32">
                        <b-form-input
                          id="input-32"
                          required
                          placeholder="Address Line 1"
                        ></b-form-input>
                      </b-form-group>
                    </b-col>

                    <b-col md="4">
                      <b-form-group id="input-group-33" label="Address Line 2:" label-for="input-33">
                        <b-form-input
                          id="input-33"
                          required
                          placeholder="Address Line 2"
                        ></b-form-input>
                      </b-form-group>
                    </b-col>

                    <b-col md="4">
                      <b-form-group id="input-group-34" label="City:" label-for="input-34">
                        <b-form-input
                          id="input-34"
                          required
                          placeholder="Enter city"
                        ></b-form-input>
                      </b-form-group>
                    </b-col>
                  </b-row>
                </b-col>
              </b-row>

              <div class="mt-2 clearfix">
                <div class="float-right">
                  <b-button variant="maroon" size="md"><i class="fa fa-check"></i> Save</b-button>
                </div>
              </div>
            </b-tab>

            <template slot="tabs">
              <div md="3" class="pt-2 float-right">
                <b-form-input placeholder="Search Member"></b-form-input>
              </div>
            </template>

            <template slot="tabs" v-if="tabs.childTabsDisabled">
              <b-alert variant="maroon" class="help-alert animated bounceIn delay-2s" dismissible v-model="tabs.showHelpAlert">
                <i class="fa fa-info-circle mr-1"></i> If other tabs has blocked, except <strong>Personal Tab</strong>: Try enter and <strong>save personal details</strong>, or <strong>search and select member</strong>!
              </b-alert>
            </template>
          </b-tabs>
        </Widget>
      </b-col>
    </b-row>
  </div>
</template>


<script>
import Widget from 'RESO/js/components/Widget/Widget';
import { validationMixin } from 'vuelidate'
import { required, minLength } from 'vuelidate/lib/validators'

export default {
  name: 'AnotherPage',
  components: { Widget },
  mixins: [validationMixin],
  data() {
    return {
      tabs:{
        showHelpAlert: true,
        childTabsDisabled: true
      },
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
      form_personal: {

      }
    }
  },
  validations: {

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
    show_why_disabled(){
      console.log("clicked");
      if (this.tabs.childTabsDisabled){
        alert ('Please fill basic/personal details first or search and select existing member to edit!!');
      }
    },
    submitPersonal(){
      console.log("Form submit fired!!");
      this.tabs.childTabsDisabled = false;
    }
  },
  created() {
    this.all_titles();
    this.all_nationalities();
    this.all_religions();
    this.all_provinces();
    this.all_languages();
  }
};
</script>

<style src="./MemberNew.scss" lang="scss" scoped />