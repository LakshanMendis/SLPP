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
              <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-1" label="Category Name:" label-for="input-1">
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
            <div class="mt-4 clearfix">
              <div class="float-right">
                <b-button variant="maroon" size="md"><i class="fa fa-check"></i> Save</b-button>
              </div>
              <div class="float-left">
                <b-button variant="warning" size="md"><i class="fa fa-plus"></i> New</b-button>
              </div>
            </div>
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
  name: 'AnotherPage',
  components: { Widget },
  data() {
    return {
      message: 'Test message'
    }
  }
};
</script>
