<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>View Members</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Member - <span class="fw-semi-bold">View</span>
    </h1>

    <b-row>
      <b-col lg="12">
        <Widget title="<h5>Member <span class='fw-semi-bold'>Search</span></h5>" 
        customHeader collapse>
          <b-tabs content-class="mt-3">
            <b-tab title="Personal" active>
              <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-1" label="Membership ID:" label-for="membership_id">
                    <b-form-input
                      id="membership_id"
                      placeholder="Membership ID"
                      v-model="form_personal.membership_id"
                    ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group id="input-group-2" label="Name (Like):" label-for="name">
                    <b-form-input
                      id="name"
                      placeholder="Member name"
                       v-model="form_personal.name"
                    ></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>

              <b-row>
                <b-col md="6">
                  <b-form-group id="group_nationality" label="Nationality:" label-for="nationality">
                    <b-form-select 
                      class="mb-3" 
                      id="nationality"
                      name="nationality"
                      v-model="form_personal.nationality"
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
                        <b-form-group id="religion" label="Religion:" label-for="religion">
                          <b-form-select 
                            class="mb-3" 
                            id="religion"
                            name="religion"
                            v-model="form_personal.religion"
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
            </b-tab>

            <b-tab title="Electoral">
              <b-row>
                <b-col md="12">
                  <b-row>
                    <b-col md="12">
                      <b-row>
                        <b-col md="12">
                          <b-row>
                            <b-col md="6">
                              <b-form-group id="group_province" label="Province:" label-for="province">
                                <b-form-select class="mb-3" id="province" @change="all_districts($event);all_electorates($event);" v-model="form_electoral.province">
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
                              <b-form-group id="group_district" label="District:" label-for="district">
                                <b-form-select class="mb-3" id="district" @change="all_local_auths($event);" v-model="form_electoral.district">
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
                              <b-form-group id="group_electorate" label="Electorate:" label-for="electorate">
                                <b-form-select class="mb-3" id="electorate" v-model="form_electoral.electorate">
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
                              <b-form-group id="group_local_auth" label="Local Authority:" label-for="local_auth">
                                <b-form-select class="mb-3" id="local_auth" @change="all_wards($event);" v-model="form_electoral.local_auth">
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
                                <b-form-group id="group_ward" label="Ward:" label-for="ward">
                                  <b-form-select class="mb-3" id="ward" @change="all_gndivs($event);" v-model="form_electoral.ward">
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
                                <b-form-group id="group_gn" label="GN Division:" label-for="gn_div">
                                  <b-form-select class="mb-3" id="gn_div" v-model="form_electoral.gn_div">
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
                    </b-col>
                  </b-row>
                </b-col>
              </b-row>
            </b-tab>

            <b-tab title="Category">
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
            </b-tab>
          </b-tabs>

          <div class="mt-3 clearfix">
            <div class="float-right ml-3">
              <b-button variant="maroon" size="md" type="button" @click="search"><i class="fa fa-search"></i> Search</b-button>
            </div>
            <div class="float-right ml-3">
              <b-button variant="info" size="md" type="button" @click="pdf"><i class="fa fa-file-pdf-o"></i> PDF</b-button>
            </div>
            <div class="float-left">
              <b-button variant="primary" size="md" type="button" @click="resetAll"><i class="fa fa-undo"></i> Reset</b-button>
            </div>
          </div>
        </Widget>
        
        <Widget>
          <div class="table-responsive widget-table-overflow">
            <b-table
              id="member-table"
              :items="tableProvider"
              :per-page="table.perPage"
              :api-url="table.url"
              :current-page="table.currentPage"
              :busy.sync="table.isBusy"
              :striped="true"
              :hover="true"
              primary-key="id"
              selectable
              select-mode="single"
              selectedVariant="maroon"
            >
              <template slot="image" slot-scope="row">
                <div class="text-center">
                  <img v-if="row.value" :src="row.value" width="50" height="50">
                  <img v-if="!row.value" src="../../assets/avatar.png" width="50" height="50">
                </div>
              </template>
            </b-table>
          </div>
          <div class="mt-2 clearfix">
            <div md="2" class="float-left">
              <b-form-select id="table-per-page-select" v-model="table.perPage">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
              </b-form-select>
            </div>

            <b-pagination
              v-model="table.currentPage"
              :total-rows="table.totalRows"
              :per-page="table.perPage"
              align="right"
              aria-controls="member-table"
            >
            </b-pagination>
          </div>
        </Widget>
      </b-col>
    </b-row>

    <b-modal id="modal-1" size="xl" title="Member View" ok-only>
      <b-tabs content-class="mt-3">
        <b-tab title="Personal" active>
          <b-row>
            <b-col md="3 p-4 bg-dark">
              <b-row>
                <b-col md="12" class="pb-1">
                  <b-img thumbnail fluid src="../../assets/people/a1.jpg" alt="Image 1"></b-img>
                </b-col>
              </b-row>
            </b-col>
            <b-col md="9">
              <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-1" label="Membership ID:" label-for="input-1">
                    <b-form-input id="input-1" disabled value="SLPP/01/23/11/20"></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group id="input-group-2" label="Title:" label-for="input-2">
                    <b-form-input id="input-2" disabled value="Mrs"></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>

              <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-3" label="First Name/Initials:" label-for="input-3">
                    <b-form-input id="input-3" disabled value="Soe"></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group id="input-group-4" label="Last Name:" label-for="input-4">
                    <b-form-input id="input-4" disabled value="Jane"></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>

              <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-5" label="Calling Name:" label-for="input-5">
                    <b-form-input id="input-5" disabled value="Soe Jane"></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col md="6">
                  <b-form-group id="input-group-6" label="NIC:" label-for="input-6">
                    <b-form-input id="input-6" disabled value="823467450V"></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>

              <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-7" label="Nationality:" label-for="input-7">
                    <b-form-input id="input-7" disabled value="Sinhala"></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group id="input-group-8" label="Religion:" label-for="input-8">
                    <b-form-input id="input-8" disabled value="Christian"></b-form-input>
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
              </fieldset>
            </b-col>
          </b-row>

          <b-row>
            <b-col lg="8">
              <b-form-group id="input-group-12" label="Remarks:" label-for="input-12">
                <b-form-textarea
                  id="input-12"
                  rows="3"
                  max-rows="6"
                  disabled
                >N/A</b-form-textarea>
              </b-form-group>
            </b-col>

            <b-col lg="4">
              <b-form-group id="input-group-13" label="Status:" label-for="input-13">
                <b-form-input id="input-13" value="Active" disabled></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>
        </b-tab>

        <b-tab title="Electoral">
          <b-row>
            <b-col md="12">
              <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-14" label="Province:" label-for="input-14">
                    <b-form-input id="input-14" value="Western" disabled></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group id="input-group-15" label="District:" label-for="input-15">
                    <b-form-input id="input-14" value="Gampaha" disabled></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>

              <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-16" label="Electorate:" label-for="input-16">
                    <b-form-input id="input-16" value="N/A" disabled></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group id="input-group-17" label="Local Authority:" label-for="input-17">
                    <b-form-input id="input-17" value="N/A" disabled></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>

              <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-18" label="Ward:" label-for="input-18">
                    <b-form-input id="input-18" value="N/A" disabled></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group id="input-group-19" label="GN Division:" label-for="input-19">
                    <b-form-input id="input-19" value="N/A" disabled></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>
            </b-col>
          </b-row>
        </b-tab>

        <b-tab title="Communication">
          <b-row>
            <b-col md="12">
              <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-20" label="Address Line 1:" label-for="input-20">
                    <b-form-input
                      id="input-20"
                      disabled
                      value="92/A"
                    ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group id="input-group-21" label="Address Line 2:" label-for="input-21">
                    <b-form-input
                      id="input-21"
                      disabled
                      value="Ihala Karagahamuna"
                    ></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>

              <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-22" label="City:" label-for="input-22">
                    <b-form-input
                      id="input-22"
                      disabled
                      value="Kadawatha"
                    ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group id="input-group-23" label="Postal Code:" label-for="input-23">
                    <b-form-input
                      id="input-23"
                      disabled
                      value="11300"
                    ></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>

              <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-24" label="Mobile Number 1:" label-for="input-24">
                    <b-form-input
                      id="input-24"
                      disabled
                      value="0776447552"
                    ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group id="input-group-25" label="Mobile Number 2:" label-for="input-25">
                    <b-form-input
                      id="input-25"
                      disabled
                      value="N/A"
                    ></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>

              <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-26" label="Home Tel:" label-for="input-26">
                    <b-form-input
                      id="input-26"
                      disabled
                      value="N/A"
                    ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group id="input-group-27" label="Office Tel:" label-for="input-27">
                    <b-form-input
                      id="input-27"
                      disabled
                      value="N/A"
                    ></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>

              <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-28" label="Fax:" label-for="input-28">
                    <b-form-input
                      id="input-28"
                      disabled
                      value="N/A"
                    ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group id="input-group-29" label="E-Mail:" label-for="input-29">
                    <b-form-input
                      id="input-29"
                      disabled
                      value="soej@domain.com"
                    ></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>
            </b-col>
          </b-row>
        </b-tab>

        <b-tab title="Language">
          <b-row>
            <b-col md="12">
              <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-30" label="Preferred Language:" label-for="input-30">
                    <b-form-input id="input-30" value="English" disabled></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>
            </b-col>
          </b-row>
        </b-tab>
      </b-tabs>
    </b-modal>
  </div>
</template>

<script>
import Widget from 'RESO/js/components/Widget/Widget';
import CategoryMultiple from 'RESO/js/components/CategoryMultiple/CategoryMultiple';

export default {
  name: 'MemberView',
  components: { Widget, CategoryMultiple },
  data() {
    return {
      nationalities: [],
      religions: [],
      provinces: [],
      districts: [],
      electorates: [],
      localAuths: [],
      wards: [],
      gnDivs: [],
      category_loaded: false,
      categories: [],
      category_values: [],
      category_init_values: [],
      form_personal:{
        membership_id: "",
        name: "",
        nationality: 1,
        religion: 1,
      },
      form_electoral: {
        province: 1,
        district: 1,
        electorate: 1,
        local_auth: 1,
        ward: 1,
        gn_div: 1,
      },
      table: {
        currentPage: 1,
        totalRows: 0,
        perPage: 5,
        url: '/api/members/table',
        isBusy: false,
      }
    };
  },
  methods: {
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
    all_provinces(){
      window.axios.get('/api/provinces').then(({data}) => {
        this.provinces = data;
      })
    },
    all_districts(province = 1){
      if (province == 1) return;
      
      const para = {'province_id': province};

      window.axios.get('/api/districts', { params: para }).then(({data})=>{
        this.districts = data;
      })
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
    get_categories() {
      window.axios.get('/api/categories').then(({ data }) => {
        this.categories = data;

        this.category_loaded = true;
      });
    },
    get_category_values() {
      const para = { 'member_id': 0 };

      window.axios.get('/api/categories/values', { params: para }).then(({ data }) => {
        this.category_values = data;

        if (!this.category_loaded) {
          this.category_init_values = data;
          this.get_categories();
        }
      });
    },
    resetAll(){
      this.form_personal.membership_id = '';
      this.form_personal.name = '';
      this.form_personal.nationality = 1;
      this.form_personal.religion = 1;

      this.districts = [],
      this.electorates = [],
      this.localAuths = [],
      this.wards = [],
      this.gnDivs = [],

      this.form_electoral.province = 1;
      this.form_electoral.district = 1;
      this.form_electoral.electorate = 1;
      this.form_electoral.local_auth = 1;
      this.form_electoral.ward = 1;
      this.form_electoral.gn_div = 1;

      window.axios.get('/api/categories/values').then(({ data }) => {
        this.category_values = data;
        this.$root.$emit('bv::refresh::table', 'member-table');
      });
    },
    search(){
      this.$root.$emit('bv::refresh::table', 'member-table');
    },
    pdf(){
      let filter_params = "";
      const form_category = { 'categories': this.category_values };

      filter_params = $.extend(filter_params, this.form_personal);
      filter_params = $.extend(filter_params, this.form_electoral);
      filter_params = $.extend(filter_params, form_category);

      window.axios({
        url: '/api/members/print',
        method: 'post',
        data: filter_params,
        headers: {'X-CSRF-TOKEN': token.csrf},
        responseType: 'blob'
      }).then(({ data }) => {
        const blob = new Blob([data]);
        const url = window.URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = 'members.pdf';
        document.body.appendChild(link);
        link.click();
        link.remove();
        window.URL.revokeObjectURL(url);
      });
    },
    tableProvider(ctx, callback) {
      let filter_params = "";
      const form_category = { 'categories': this.category_values };

      this.table.isBusy = true;

      filter_params = $.extend(filter_params, this.form_personal);
      filter_params = $.extend(filter_params, this.form_electoral);
      filter_params = $.extend(filter_params, form_category);
      filter_params = $.extend(filter_params, ctx);

      window.axios.post(ctx.apiUrl, filter_params)
      .then(({data}) => {
        this.table.isBusy = false;
        this.table.totalRows = data.totalRows;
        callback(data.data);
      })
      .catch((e) => {
        console.error(e);
        this.table.isBusy = false;
        this.table.totalRows = 0;
        callback([]);
      });

      return null;
    }
  },
  created(){
    this.all_provinces();
    this.all_religions();
    this.all_nationalities();
    this.get_category_values();
  }
};
</script>
