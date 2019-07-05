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
        <Widget title="<h5>Member <span class='fw-semi-bold'>Search</span></h5>" 
        customHeader collapse>
          <b-tabs content-class="mt-3">
            <b-tab title="Personal" active>
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
                    <b-button type="submit" variant="maroon" size="md"><i class="fa fa-check"></i> Save</b-button>
                  </div>
                  <div class="float-left">
                    <b-button type="reset" variant="warning" size="md"><i class="fa fa-plus"></i> New</b-button>
                  </div>
                </div>
              </b-form>
            </b-tab>

            <b-tab title="Options">
              <b-row>
                <b-col md="12">
                  <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-1" label="Option Name:" label-for="input-1">
                    <b-form-input
                      id="input-1"
                      placeholder="Category Name"
                    ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group id="input-group-2" label="Status:" label-for="input-2">
                    <b-form-select class="mb-3" id="input-2">
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
                <b-button variant="maroon" size="md"><i class="fa fa-check"></i> Save</b-button>
              </div>
              <!-- <div class="float-left">
                <b-button variant="warning" size="md"><i class="fa fa-plus"></i> New</b-button>
              </div> -->
            </div>
            </b-tab>

            <template slot="tabs">
              <div md="3" class="pt-2 float-right">
                <b-form-input placeholder="Search Member"></b-form-input>
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
      category_header: {
        name: "",
        status: 1
      }
    }
  },
  methods: {
    save_category() {
      const para = this.category_header;

      window.axios.get('/api/category_headers/create', { params: para }).then(({ data }) => {
        this.$swal('Success', 'Category created successfully!!', 'success');
      }).catch((e) => {
        this.$swal('Error', 'Category create failed', 'error');
      });
    },
    reset_category (){
      this.category_header.name = "";
      this.category_header.status = 1;
    }
  }
};
</script>
