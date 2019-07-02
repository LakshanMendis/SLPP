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
              <b-form name="formPersonal" id="formPersonal" @submit.stop.prevent="submitPersonal()" @reset.stop.prevent="resetAll()" novalidate>
                <b-row>
                  <b-col md="3 p-4 bg-dark">
                    <b-row>
                      <b-col md="12" class="pb-1">
                        <b-img class="prof_img" thumbnail fluid src="http://leadership.hscni.net/Images/Uploads/anon_user.png" alt="Image 1"></b-img>
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
                        <b-form-group id="group_membership_id" label="*Membership ID:" label-for="text_membership_id" :class="{ 'form-group--error': $v.form_personal.text_membership_id.$error }">
                          <b-form-input
                            id="text_membership_id"
                            name="text_membership_id"
                            placeholder="Enter Membership ID"
                            aria-describedby="feedback_membership_id"
                            v-model="$v.form_personal.text_membership_id.$model"
                            :state="$v.form_personal.text_membership_id.$dirty ? !$v.form_personal.text_membership_id.$error : null"
                          ></b-form-input>
                          <b-form-invalid-feedback id="feedback_membership_id">
                            This is a required field.
                          </b-form-invalid-feedback>
                        </b-form-group>
                      </b-col>
                      <b-col md="6">
                        <b-form-group id="group_title" label="Title:" label-for="select_title">
                          <b-form-select 
                            class="mb-3"
                            id="select_title"
                            name="select_title"
                            v-model="form_personal.select_title"
                          >
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
                        <b-form-group id="group_firstname" label="*First Name/Initials:" label-for="text_firstname" :class="{ 'form-group--error': $v.form_personal.text_firstname.$error }">
                          <b-form-input
                            id="text_firstname"
                            name="text_firstname"
                            placeholder="First Name/Initials"
                            aria-describedby="feedback_firstname"
                            v-model="$v.form_personal.text_firstname.$model"
                            :state="$v.form_personal.text_firstname.$dirty ? !$v.form_personal.text_firstname.$error : null"
                          ></b-form-input>
                          <b-form-invalid-feedback id="feedback_firstname">
                            This is a required field.
                          </b-form-invalid-feedback>
                        </b-form-group>
                      </b-col>
                      <b-col md="6">
                        <b-form-group id="group_lastname" label="Last Name:" label-for="text_lastname">
                          <b-form-input
                            id="text_lastname"
                            name="text_lastname"
                            placeholder="Last Name"
                            v-model="form_personal.text_lastname"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>

                    <b-row>
                      <b-col md="6">
                        <b-form-group id="group_callingname" label="*Calling Name:" label-for="text_callingname" :class="{ 'form-group--error': $v.form_personal.text_callingname.$error }">
                          <b-form-input
                            id="text_callingname"
                            name="text_callingname"
                            placeholder="Calling Name"
                            aria-describedby="feedback_callingname"
                            v-model="$v.form_personal.text_callingname.$model"
                            :state="$v.form_personal.text_callingname.$dirty ? !$v.form_personal.text_callingname.$error : null"
                          ></b-form-input>
                          <b-form-invalid-feedback id="feedback_callingname">
                            This is a required field.
                          </b-form-invalid-feedback>
                        </b-form-group>
                      </b-col>
                      <b-col md="6">
                        <b-form-group id="group_nic" label="*NIC:" label-for="text_nic" :class="{ 'form-group--error': $v.form_personal.text_nic.$error }">
                          <b-form-input
                            id="text_nic"
                            name="text_nic"
                            placeholder="NIC"
                            aria-describedby="feedback_nic"
                            v-model="$v.form_personal.text_nic.$model"
                            :state="$v.form_personal.text_nic.$dirty ? !$v.form_personal.text_nic.$error : null"
                          ></b-form-input>
                          <b-form-invalid-feedback id="feedback_nic">
                            This is a required field.
                          </b-form-invalid-feedback>
                        </b-form-group>
                      </b-col>
                    </b-row>

                    <b-row>
                      <b-col md="6">
                        <b-form-group id="group_nationality" label="Nationality:" label-for="select_nationality">
                          <b-form-select 
                            class="mb-3" 
                            id="select_nationality"
                            name="select_nationality"
                            v-model="form_personal.select_nationality"
                          >
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
                        <b-form-group id="group_religion" label="Religion:" label-for="select_religion">
                          <b-form-select 
                            class="mb-3" 
                            id="select_religion"
                            name="select_religion"
                            v-model="form_personal.select_religion"
                          >
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
                  <b-col lg="8" class="pt-4">
                    <b-form-group id="group_remarks" label="Remarks:" label-for="text_remarks">
                      <b-form-textarea
                        id="text_remarks"
                        name="text_remarks"
                        placeholder="Remarks..."
                        rows="3"
                        max-rows="6"
                        v-model="form_personal.text_remarks"
                      ></b-form-textarea>
                    </b-form-group>
                  </b-col>

                  <b-col lg="4" class="pt-4">
                    <b-form-group id="group_status" label="Status:" label-for="select_status">
                      <b-form-select 
                        class="mb-3" 
                        id="select_status"
                        name="select_status"
                        v-model="form_personal.select_status"
                      >
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

                <div class="mt-2 clearfix">
                  <div class="float-right">
                    <b-button type="submit" variant="maroon" size="md"><i class="fa fa-check"></i> Save</b-button>
                  </div>
                </div>
              </b-form>
            </b-tab>

            <b-tab title="Communication" :disabled="tabs.childTabsDisabled">
              <b-form name="formCommunication" id="formCommunication" @submit.stop.prevent="updateAll()" @reset.stop.prevent="resetAll()" novalidate>
                <b-row>
                  <b-col md="12">
                    <b-row>
                      <b-col md="6">
                        <b-form-group id="group_address_line1" label="Address Line 1:" label-for="text_address_line1">
                          <b-form-input
                            id="text_address_line1"
                            name="text_address_line1"
                            v-model="form_communication.text_address_line1"
                            placeholder="Address Line 1"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="group_address_line2" label="Address Line 2:" label-for="text_address_line2">
                          <b-form-input
                            id="text_address_line2"
                            name="text_address_line2"
                            v-model="form_communication.text_address_line2"
                            placeholder="Address Line 2"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>

                    <b-row>
                      <b-col md="6">
                        <b-form-group id="group_city" label="City:" label-for="text_city">
                          <b-form-input
                            id="text_city"
                            name="text_city"
                            v-model="form_communication.text_city"
                            placeholder="City"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="group_postalcode" label="Postal Code:" label-for="text_postalcode">
                          <b-form-input
                            id="text_postalcode"
                            name="text_postalcode"
                            v-model="form_communication.text_postalcode"
                            placeholder="Postal Code"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>

                    <b-row>
                      <b-col md="6">
                        <b-form-group id="group_mobile1" label="Mobile Number 1 (Whatsapp Preferred):" label-for="text_mobile1">
                          <b-form-input
                            id="text_mobile1"
                            name="text_mobile1"
                            v-model="form_communication.text_mobile1"
                            placeholder="Mobile Number 1"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="group_mobile2" label="Mobile Number 2:" label-for="text_mobile2">
                          <b-form-input
                            id="text_mobile2"
                            name="text_mobile2"
                            v-model="form_communication.text_mobile2"
                            placeholder="Mobile Number 2"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>

                    <b-row>
                      <b-col md="6">
                        <b-form-group id="group_home_tel" label="Home Tel:" label-for="text_home_tel">
                          <b-form-input
                            id="text_home_tel"
                            name="text_home_tel"
                            v-model="form_communication.text_home_tel"
                            placeholder="Home Tel"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="group_office_tel" label="Office Tel:" label-for="text_office_tel">
                          <b-form-input
                            id="text_office_tel"
                            name="text_office_tel"
                            v-model="form_communication.text_office_tel"
                            placeholder="Office Tel"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>

                    <b-row>
                      <b-col md="6">
                        <b-form-group id="group_fax" label="Fax:" label-for="text_fax">
                          <b-form-input
                            id="text_fax"
                            name="text_fax"
                            v-model="form_communication.text_fax"
                            placeholder="Fax"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="group_email" label="E-Mail:" label-for="text_email">
                          <b-form-input
                            id="text_email"
                            name="text_email"
                            v-model="form_communication.text_email"
                            placeholder="E-Mail"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                  </b-col>
                </b-row>

                <div class="mt-2 clearfix">
                  <div class="float-right">
                    <b-button type="submit" variant="maroon" size="md"><i class="fa fa-check"></i> Save</b-button>
                  </div>
                </div>
              </b-form>
            </b-tab>

            <b-tab title="Categories" :disabled="tabs.childTabsDisabled">
              <b-form name="formCategories" id="formCategories" @submit.stop.prevent="updateAll()" @reset.stop.prevent="resetAll()" novalidate>
                <b-row>
                  <b-col md="12" class="pt-3 pb-2">
                    <CategoryMultiple 
                      v-for="(category, index) in categories" 
                      :key="category.id" 
                      :id="category.textId" 
                      :label="category.label" 
                      :placeholder="category.label" 
                      :options="category.options"
                      v-model="category_values[index].value"
                    >
                    </CategoryMultiple>
                  </b-col>
                </b-row>

                <div class="mt-2 clearfix">
                  <div class="float-right">
                    <b-button type="submit" variant="maroon" size="md"><i class="fa fa-check"></i> Save</b-button>
                  </div>
                </div>
              </b-form>
            </b-tab>

            <b-tab title="Language" :disabled="tabs.childTabsDisabled">
              <b-form name="formLanguage" id="formLanguage" @submit.stop.prevent="updateAll()" @reset.stop.prevent="resetAll()" novalidate>
                <b-row>
                  <b-col md="12">
                    <b-row>
                      <b-col md="6">
                        <b-form-group id="group_pref_language" label="Preferred Language:" label-for="select_pref_lang">
                          <b-form-select class="mb-3" id="select_pref_lang" name="select_pref_lang" v-model="form_language.select_pref_lang">
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
                        <b-form-group id="group_pref_name" label="Name:" label-for="text_pref_name">
                          <b-form-input
                            id="text_pref_name" 
                            name="text_pref_name" 
                            v-model="form_language.text_pref_name"
                            placeholder="Enter name with initials"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>

                    <b-row>
                      <b-col md="4">
                        <b-form-group id="group_pref_address_line1" label="Address Line 1:" label-for="text_pref_address_line1">
                          <b-form-input
                            id="text_pref_address_line1" 
                            name="text_pref_address_line1" 
                            v-model="form_language.text_pref_address_line1"
                            placeholder="Address Line 1"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="group_pref_address_line2" label="Address Line 2:" label-for="text_pref_address_line2">
                          <b-form-input
                            id="text_pref_address_line2" 
                            name="text_pref_address_line2" 
                            v-model="form_language.text_pref_address_line2"
                            placeholder="Address Line 2"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="group_pref_city" label="City:" label-for="text_pref_city">
                          <b-form-input
                            id="text_pref_city"
                            name="text_pref_city" 
                            v-model="form_language.text_pref_city"
                            placeholder="Enter city"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>
                    </b-row>
                  </b-col>
                </b-row>

                <div class="mt-2 clearfix">
                  <div class="float-right">
                    <b-button type="submit" variant="maroon" size="md"><i class="fa fa-check"></i> Save</b-button>
                  </div>
                </div>
              </b-form>
            </b-tab>

            <template slot="tabs">
              <div md="3" class="pl-3 float-right">
                <multiselect v-model="search.select_member" class="search_member" id="search_member" placeholder="Search Member" open-direction="bottom" :options="search.load_members" :multiple="false" :searchable="true" :loading="search.loading" :internal-search="false" :clear-on-select="false" :close-on-select="true" :options-limit="300" :limit="3" :limit-text="limitText" :max-height="300" :show-no-results="true" :hide-selected="false" @search-change="searchMember" @select="selectedMember">
                  <span slot="noResult">No matching members found</span>
                  <template slot="singleLabel" slot-scope="props"><span class="option__desc"><span class="option__title">[{{ props.option.membership_id }}] {{ props.option.firstname }} {{ props.option.lastname }}</span></span></template>
                  <template slot="option" slot-scope="props">
                    <div class="option__desc"><span class="option__title">[{{ props.option.membership_id }}] {{ props.option.firstname }} {{ props.option.lastname }}</span></div>
                  </template>
                </multiselect>
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

      this.$v.$reset();

      this.form_personal.text_membership_id = '';
      this.form_personal.select_title = '';
      this.form_personal.text_firstname = '';
      this.form_personal.text_lastname = '';
      this.form_personal.text_callingname = '';
      this.form_personal.text_nic = '';
      this.form_personal.select_nationality = 1;
      this.form_personal.select_religion = 1;
      this.form_personal.text_remarks = '';
      this.form_personal.select_status = 1;

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

      this.form_communication.text_address_line1 = "";
      this.form_communication.text_address_line2 = "";
      this.form_communication.text_city = "";
      this.form_communication.text_postalcode = "";
      this.form_communication.text_mobile1 = "";
      this.form_communication.text_mobile2 = "";
      this.form_communication.text_home_tel = "";
      this.form_communication.text_office_tel = "";
      this.form_communication.text_fax = "";
      this.form_communication.text_email = "";

      this.category_values = this.category_init_values;

      this.form_language.select_pref_lang = 1;
      this.form_language.text_pref_name = "";
      this.form_language.text_pref_address_line1 = "";
      this.form_language.text_pref_address_line2 = "";
      this.form_language.text_pref_city = "";
    },
    saveCategories() {
      const member_id = this.global_member_id;
    
      let submit_array = {};
      let member_array = { member_id : member_id };
      let values_array = { values: this.category_values };

      submit_array = $.extend(submit_array, member_array);
      submit_array = $.extend(submit_array, values_array);

      window.axios.get('/api/categories/create', { params: submit_array }).then(({ data }) => {
        console.log(data);
      });
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
    submitPersonal(){
      this.$v.form_personal.$touch();

      if (this.$v.form_personal.$anyError) {
        console.error("Form submit validate errors on personal form");
        return
      }

      console.log("personal form ready to submit, no validation errors!!");

      if (this.global_member_id > 0){
        this.updateAll();
      }else{
        window.axios.get('/api/members/create', { params: this.form_personal }).then(({ data }) => {
          if (data.id) {
            this.global_member_id = data.id;
            this.$swal('Success', 'Member created successfully!!', 'success');
            this.tabs.childTabsDisabled = false;
          }
        });
      }
    },
    limitText (count) {
      return `and ${count} other members`
    },
    searchMember (query) {
      this.search.loading = true;

      const para = { 'search': query };

      window.axios.get('/api/members/search', { params: para }).then(({ data }) => {
        this.search.loading = false;
        this.search.load_members = data;
      });
    },
    selectedMember (selectedOption){
      this.search.select_member = selectedOption;
      this.global_member_id = this.search.select_member.id;
      this.tabs.childTabsDisabled = false;

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

<style src="./MemberNew.scss" lang="scss" scoped />