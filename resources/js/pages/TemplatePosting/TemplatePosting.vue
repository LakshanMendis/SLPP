<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>Posting</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Template - <span class="fw-semi-bold">Posting</span>
    </h1>

    <b-row>
      <b-col lg="12">
        <Widget>
          <form-wizard step-size="sm" title="Post Wizard" subtitle="Follow steps to send or schedule mail campaign!" @on-complete="finished()">
            <tab-content title="Media">
              <h4>Select media to distribute</h4>
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
              
              <h4 class="mt-5">Select other options</h4><hr />

              <b-row>
                <b-col md="4">
                  <b-form-group id="group_sms" label="SMS Sender ID:" label-for="sms_option">
                    <b-form-select
                      class="mb-3"
                      id="sms_option"
                      name="sms_option"
                      :disabled="sms_option_disabled"
                      v-model="selected_sms_sender"
                    >
                      <option :value="[]" disabled>Select Sender</option>
                      <option
                        v-for="data in sms_senders"
                        :value="data"
                        :key="data.id"
                      >{{ data.name + " [" + data.sender_id + "]" }}</option>
                    </b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="4">
                  <b-form-group id="group_email" label="E-Mail Sender:" label-for="email_option">
                    <b-form-select
                      class="mb-3"
                      id="email_option"
                      name="email_option"
                      :disabled="email_option_disabled"
                      v-model="selected_email_sender"
                    >
                      <option :value="[]" disabled>Select Sender</option>
                      <option
                        v-for="data in email_senders"
                        :value="data"
                        :key="data.id"
                      >{{ data.caption + "/" + data.name + "/" + data.email }}</option>
                    </b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="4">
                  <b-form-group id="group_print" label="From Address:" label-for="print_option">
                    <b-form-select
                      class="mb-3"
                      id="print_option"
                      name="print_option"
                      :disabled="print_option_disabled"
                      v-model="selected_print_sender"
                    >
                      <option :value="[]" disabled>Select Sender</option>
                      <option
                        v-for="data in locations"
                        :value="data"
                        :key="data.id"
                      >{{ data.location }}</option>
                    </b-form-select>
                  </b-form-group>
                </b-col>
              </b-row>
            </tab-content>

            <tab-content title="Audience">
              <h4>Target</h4><hr />

              <b-row>
                <b-col md="12">
                  <b-row>
                    <b-col md="4">
                      <b-form-group id="group_target_type" label="" label-for="target_type">
                        <b-form-select
                          class="mb-3"
                          id="target_type"
                          name="target_type"
                          v-model="target_type"
                          @change="type_changed"
                        >
                          <option value="multiple">Multiple Members</option>
                          <option value="single">Single Member</option>
                        </b-form-select>
                      </b-form-group>
                    </b-col>

                    <b-col md="4">
                      <b-button variant="info" size="md" @click="reset_this()"><i class="fa fa-refresh"></i> Reset</b-button>
                    </b-col>
                  </b-row>
                </b-col>
              </b-row>

              <div id="single_filters" v-if="!show_multiple">
                <b-row>
                  <b-col md="12" class="mt-3">
                    <h5>Search & Select Member</h5><hr />

                    <b-col md="12" class="mt-4 mb-4">
                      <multiselect v-model="search.select_member" class="search_member" id="search_member" placeholder="Search Member" open-direction="bottom" :options="search.load_members" :multiple="false" :searchable="true" :loading="search.loading" :internal-search="false" :clear-on-select="false" :close-on-select="true" :options-limit="300" :limit="3" :limit-text="limitText" :max-height="300" :show-no-results="true" :hide-selected="false" @search-change="searchMember" @select="selectedMember">
                        <span slot="noResult">No matching members found</span>
                        <template slot="singleLabel" slot-scope="props"><span class="option__desc"><span class="option__title">[{{ props.option.membership_id }}] {{ props.option.firstname }} {{ props.option.lastname }}</span></span></template>
                        <template slot="option" slot-scope="props">
                          <div class="option__desc"><span class="option__title">[{{ props.option.membership_id }}] {{ props.option.firstname }} {{ props.option.lastname }}</span></div>
                        </template>
                      </multiselect>
                    </b-col>
                  </b-col>
                </b-row>
              </div>

              <div id="multiple_filters" v-if="show_multiple">
                <h5>Electoral</h5><hr />

                <b-row>
                  <b-col md="12">
                    <b-row>
                      <b-col md="6">
                        <b-form-group id="group_province" label="Province:" label-for="select_province">
                          <b-form-select class="mb-3" id="select_province" @change="all_districts($event);all_electorates($event);get_member_count();" v-model="form_electoral.select_province">
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
                          <b-form-select class="mb-3" id="select_district" @change="all_local_auths($event);get_member_count();" v-model="form_electoral.select_district">
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
                          <b-form-select class="mb-3" id="select_electorate" @change="get_member_count();" v-model="form_electoral.select_electorate">
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
                          <b-form-select class="mb-3" id="select_local_auth" @change="all_wards($event);get_member_count();" v-model="form_electoral.select_local_auth">
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
                          <b-form-select class="mb-3" id="select_ward" @change="all_gndivs($event);get_member_count();" v-model="form_electoral.select_ward">
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
                          <b-form-select class="mb-3" id="select_gn" @change="get_member_count();" v-model="form_electoral.select_gn">
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

                <h5 class="mt-4">Category</h5><hr />

                <b-row>
                  <b-col md="12" class="pt-3 pb-2">
                    <Category 
                      v-for="(category, index) in categories" 
                      :key="category.id" 
                      :id="category.textId" 
                      :label="category.label" 
                      :placeholder="category.label" 
                      :options="category.options"
                      v-model="category_values[index].value"
                      @change="get_member_count();"
                    >
                    </Category>
                  </b-col>
                </b-row>
              </div>
            </tab-content>

            <tab-content title="Message">
              <b-row>
                <b-col md="6">
                  <b-form-group id="gr-select-template" label="Select Template:" label-for="select-template">
                    <b-form-select
                      class="mb-2"
                      id="select-template"
                      name="select-template"
                      v-model="selected_template"
                    >
                      <option value="0" selected disabled>Select Template</option>
                      <option
                        v-for="data in templates"
                        :value="data.id"
                        :key="data.id"
                      >{{ data.name + "/" + data.template_date + "/" + data.target }}</option>
                    </b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group id="gr-language" label="Language Option:" label-for="language">
                    <b-form-select
                      class="mb-1"
                      id="language"
                      name="language"
                      v-model="selected_language"
                    >
                      <option value="0" selected>Automatic</option>
                      <option
                        v-for="data in languages"
                        :value="data.id"
                        :key="data.id"
                      >{{ data.language + " - " + data.caption }}</option>
                    </b-form-select>
                  </b-form-group>
                </b-col>
              </b-row>
            </tab-content>

            <tab-content title="Send">
              <b-row align-h="center">
                <b-col md="12">
                  <b-card bg-variant="maroon" text-variant="white" header-tag="header" footer-tag="footer" class="mb-4">
                    <h4 slot="header" class="mb-0">Summary</h4>

                    <b-card-text>
                      <b-row align-h="center">
                        <b-col md="6">
                          <li class="mt-3 mb-3">
                            <strong>{{ selected_media.length }} Media</strong> Selected: 
                            <b-badge
                              v-for="media in selected_media"
                              :key="media"
                              variant="light"
                              class="ml-2 pull-right"
                            >{{ media }}</b-badge>
                          </li>

                          <li v-if="!sms_option_disabled" class="mt-3 mb-3">
                            <strong>SMS</strong> using:
                            <b-badge variant="light" class="ml-2 pull-right">{{ selected_sms_sender.sender_id }}</b-badge>
                          </li>

                          <li v-if="!email_option_disabled" class="mt-3 mb-3">
                            <strong>EMAIL</strong> using:
                            <b-badge variant="light" class="ml-2 pull-right">{{ selected_email_sender.email }}</b-badge>
                          </li>

                          <li v-if="!print_option_disabled" class="mt-3 mb-3">
                            <strong>PRINT</strong> using:
                            <b-badge variant="light" class="ml-2 pull-right">{{ selected_print_sender.location }}</b-badge>
                          </li>

                          <li v-if="show_multiple" class="mt-3 mb-3">
                            <strong>Multiple</strong> audience: target
                            <b-badge variant="light" class="ml-2 pull-right">{{ summary.filtered_member_count }} Members</b-badge>
                            <b-button class="ml-2 pull-right" size="xs" @click="viewMembers" variant="primary">
                              <i class="fa fa-search"></i>
                            </b-button>
                          </li>

                          <li v-if="!show_multiple" class="mt-3 mb-3">
                            <strong>Single</strong> audience: target
                            <b-badge variant="light" class="ml-2 pull-right">{{ "[" + search.select_member.membership_id + "] " + search.select_member.firstname + " " + search.select_member.lastname }}</b-badge>
                            <b-button class="ml-2 pull-right" size="xs" @click="viewMember" variant="primary">
                              <i class="fa fa-search"></i>
                            </b-button>
                          </li>

                          <li class="mt-3 mb-3"><strong>Template</strong> selection <b-badge variant="light" class="ml-2 pull-right">{{ summary.template_badge }}</b-badge></li>
                          <li class="mt-3 mb-3"><strong>{{ summary.language_badge }}</strong> Language Selection</li>
                        </b-col>
                      </b-row>
                    </b-card-text>

                    <em slot="footer"><p class="text-light pull-right">Click <strong>Finish</strong> to proceed or exit to cancel!</p></em>
                  </b-card>
                </b-col>
              </b-row>
            </tab-content>
          </form-wizard>
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
        { text: 'SMS', value: 'SMS' },
        { text: 'E-mail', value: 'EMAIL' },
        { text: 'Printed', value: 'PRINT' },
      ],
      sms_option_disabled: true,
      selected_sms_sender: [],
      email_option_disabled: true,
      selected_email_sender: [],
      print_option_disabled: true,
      selected_print_sender: [],
      sms_senders: [],
      email_senders: [],
      locations: [],
      provinces: [],
      districts: [],
      electorates: [],
      localAuths: [],
      wards: [],
      gnDivs: [],
      languages: [],
      category_loaded: false,
      categories: [],
      category_values: [],
      templates: [],
      target_type: "multiple",
      show_multiple: true,
      form_electoral: {
        select_province: 1,
        select_district: 1,
        select_electorate: 1,
        select_local_auth: 1,
        select_ward: 1,
        select_gn: 1
      },
      search: {
        select_member: '',
        load_members: [],
        loading: false
      },
      selected_template: 0,
      selected_language: 0,
      summary: {
        filtered_member_count: 0,
        template_badge: "",
        language_badge: "Automatic"
      }
    }
  },
  methods: {
    media_changed () {
      const has_sms = this.selected_media.includes("SMS");
      const has_email = this.selected_media.includes("EMAIL");
      const has_print = this.selected_media.includes("PRINT");

      this.sms_option_disabled = !has_sms;
      this.email_option_disabled = !has_email;
      this.print_option_disabled = !has_print;
    },
    all_sms_senders() {
      window.axios.get('/api/sms_senders').then(({ data }) => {
        this.sms_senders = data;
      });
    },
    all_email_senders() {
      window.axios.get('/api/email_senders').then(({ data }) => {
        this.email_senders = data;
      });
    },
    all_locations() {
      window.axios.get('/api/locations').then(({ data }) => {
        this.locations = data;
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
      window.axios.get('/api/categories/values').then(({ data }) => {
        this.category_values = data;

        if (!this.category_loaded) {
          this.get_categories();
        }
      });
    },
    all_active_templates() {
      let para = { 'query': 'all-active' };

      window.axios.get('/api/templates', { params: para }).then(({ data }) => {
        this.templates = data;
      });
    },
    reset_this(){
      this.search.select_member = "";
      this.get_category_values();
      this.get_member_count ();

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
    type_changed(){
      if (this.target_type == 'multiple') {
        this.show_multiple = true;
      } else {
        this.show_multiple = false;
      }

      this.reset_this();
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
    selectedMember (selectedOption) {
      this.search.select_member = selectedOption;
    },
    get_member_count () {
      let data_all = {};
      let category_values = {
        categories: this.category_values
      }

      data_all = $.extend(data_all, this.form_electoral);
      data_all = $.extend(data_all, category_values);

      window.axios.get('/api/members/count', { params: data_all }).then(({ data }) => {
        this.summary.filtered_member_count = data[0].C;
      });
    },
    viewMembers () {

    },
    viewMember () {
      
    },
    finished () {
      let para = {};
      let message_options = {
        template_id: this.selected_template,
        language_id: this.selected_language
      };
      let category_values = {
        categories: this.category_values
      }

      if (this.target_type == "multiple") {
        para = $.extend(para, this.form_electoral);
        para = $.extend(para, category_values);
        para = $.extend(para, message_options);
      }else{
        para = {
          member_id: this.search.select_member.id
        }

        para = $.extend(para, message_options);
      }

      this.selected_media.forEach(el => {
        switch (el) {
          case 'SMS':
            window.axios.get('/api/posts/sms', { params: para }).then(({ data }) => {
              console.log(data);
            });
          break;
          
          case 'PRINT':
            window.axios.get('/api/posts/print', { params: para }).then(({ data }) => {
              console.log(data);
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

<style src="./TemplatePosting.scss" lang="scss" scoped />