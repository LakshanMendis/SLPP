<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>Categories</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Member - <span class="fw-semi-bold">Categories</span>
    </h1>

    <b-row>
      <b-col lg="12">
        <Widget title customHeader collapse>
          <b-tabs content-class="mt-3">
            <b-tab title="Header" active>
              <b-form name="form-category" id="form-category" method="get" @submit.stop.prevent="save_category" @reset.stop.prevent="reset_category">
                <b-row>
                  <b-col md="6">
                    <b-form-group id="group-cat-name" label="Category Name:" label-for="category">
                      <b-form-input
                        id="category"
                        name="category"
                        placeholder="Category Name"
                        v-model="category_header.name"
                      ></b-form-input>
                    </b-form-group>
                  </b-col>

                  <b-col md="6">
                    <b-form-group id="group-status" label="Status:" label-for="status">
                      <b-form-select
                        class="mb-3"
                        id="status"
                        name="status"
                        v-model="category_header.status"
                      >
                        <option value="" selected disabled>Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </b-form-select>
                    </b-form-group>
                  </b-col>
                </b-row>
                <div class="mt-4 clearfix">
                  <div class="float-right">
                    <b-input hidden type="text" id="categoryID" name="categoryID" value="0" v-model="category_detail.categoryID"></b-input>
                    <b-button type="submit" variant="maroon" size="md"><i class="fa fa-check"></i> Save</b-button>
                  </div>
                  <div class="float-left">
                    <b-button type="reset" variant="warning" size="md"><i class="fa fa-plus"></i> New</b-button>
                  </div>
                </div>
              </b-form>
            </b-tab>

            <b-tab title="Options">
               <b-form name="form-option" id="form-option" method="get" @submit.stop.prevent="save_option">
              <b-row>
                <b-col md="12">
                  <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-option" label="Option Name:" label-for="option">
                    <b-form-input
                      id="option"
                      name="option"
                      placeholder="Category Name"
                      v-model="category_detail.option"
                    ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group id="input-group-status" label="Status:" label-for="status">
                    <b-form-select class="mb-3" id="status" name="status"  v-model="category_detail.status">
                      <option value="" selected disabled>Select Status</option>
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </b-form-select>
                  </b-form-group>
                </b-col>
              </b-row>
                </b-col>
              </b-row>
              <div class="mt-4 clearfix">
              <div class="float-right">
                <b-input hidden type="text" id="detailID" name="detailID" value="0" v-model="category_detail.detailID"></b-input>
                <b-button type="submit" id="save" name="save" variant="maroon" size="md"><i class="fa fa-check"></i> Save</b-button>
              </div>
              <!-- <div class="float-left">
                <b-button variant="warning" size="md"><i class="fa fa-plus"></i> New</b-button>
              </div> -->
            </div>
               </b-form>
            </b-tab>

            <template slot="tabs">
              <div md="3" class="pt-2 float-right">
                <b-form-input placeholder="Search Category"></b-form-input>
              </div>
            </template>
          </b-tabs>
        </Widget>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import Widget from 'RESO/js/components/Widget/Widget';

export default {
  name: 'Category',
  components: { Widget },
  data() {
    return {
      message: 'Test message',
      header_id: 0,
      category_header: {
        name: "",
        status: 1
      },
      category_detail: {
        option:"",
        status: 1
      }
    }
  },
  methods: {
    save_category() {
      const para = this.category_header;

      window.axios.get('/api/category_headers/create', { params: para }).then(({ data }) => {
        this.$swal('Success', 'Category created successfully!!', 'success');
        this.header_id = data.id;
      }).catch((e) => {
        this.$swal('Error', 'Category create failed', 'error');
      });
    },
    reset_category (){
      this.header_id = 0;
      this.category_header.name = "";
      this.category_header.status = 1;
    },
    save_option() {
      let para = this.category_detail;

      para.header_id = this.header_id;

      window.axios.get('/api/category_details/create', { params: para }).then(({ data }) => {
        this.$swal('Success', 'Category created successfully!!', 'success');
      }).catch((e) => {
        this.$swal('Error', 'Category create failed', 'error');
      });
    }
  }
};
</script>
