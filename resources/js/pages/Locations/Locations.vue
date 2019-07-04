<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>Locations</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Master - <span class="fw-semi-bold">Locations</span>
    </h1>

    <b-row>
      <b-col lg="12">
        <Widget>
          

          <b-form id="formPersonal" @submit.stop.prevent="submitPersonal()">
                    <b-row>

                      
                      <b-col md="6">
                        <b-form-group id="input-group-1" label="Company:" label-for="input-1">
                          <b-form-select class="mb-3" id="input-1">
                            <option value="" selected disabled>Select Company</option>
                            
                          </b-form-select>
                        </b-form-group>

                        <b-form-group id="input-group-2" label="Location:" label-for="input-2">
                          <b-form-input
                            id="input-2"
                            required
                            value=""
                            placeholder="Enter Short Name"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>
                    
                      <b-col md="6">
                        <b-col md="12" align="center" class="map-bg pt-5 pb-5">
                            <a href="#modal-map" class="btn btn-lg btn-default pt-4 pb-4 pl-5 pr-5" data-toggle="modal" title="Click to mark location on map">
                                <span class="fa-stack">
                                    <i class="fa fa-map fa-stack-2x text-info"></i>
                                    <i class="fa fa-map-marker fa-stack-1x fa-inverse text-danger"></i>
                                </span>
                            </a>
                        </b-col>
                      </b-col>

                      <legend><i class="fa fa-angle-right"></i> Address</legend>

                      <b-col md="6">
                        <b-form-group id="input-group-3" label="Address 1:" label-for="input-3">
                          <b-form-input
                            id="input-3"
                            required
                            value=""
                            placeholder="Enter Address Line 1"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-4" label="Address 2:" label-for="input-4">
                          <b-form-input
                            id="input-4"
                            required
                            value=""
                            placeholder="Enter Address Line 2"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-5" label="Address 3:" label-for="input-5">
                          <b-form-input
                            id="input-5"
                            required
                            value=""
                            placeholder="Enter Address Line 1"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-6" label="City:" label-for="input-6">
                          <b-form-input
                            id="input-6"
                            required
                            value=""
                            placeholder="Enter City"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>
                    
                  <legend><i class="fa fa-angle-right"></i> Contacts</legend>

                      <b-col md="6">
                        <b-form-group id="input-group-7" label="Hotline:" label-for="input-7">
                          <b-form-input
                            id="input-7"
                            required
                            value=""
                            placeholder="Enter Hotline"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-8" label="Telephone 1:" label-for="input-8">
                          <b-form-input
                            id="input-8"
                            required
                            value=""
                            placeholder="Enter Telephone 1"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-9" label="Telephone 2:" label-for="input-9">
                          <b-form-input
                            id="input-9"
                            required
                            value=""
                            placeholder="Enter Telephone 2"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-10" label="Fax 1:" label-for="input-10">
                          <b-form-input
                            id="input-10"
                            required
                            value=""
                            placeholder="Enter Fax 1"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-11" label="Fax 2:" label-for="input-11">
                          <b-form-input
                            id="input-11"
                            required
                            value=""
                            placeholder="Enter Fax 2"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>


                      <b-col md="6">
                        <b-form-group id="input-group-12" label="Email:" label-for="input-12">
                          <b-form-input
                            id="input-12"
                            required
                            value=""
                            placeholder="Enter Email"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <!-- <b-col md="6">
                        <b-form-group id="input-group-13" label="Latitude:" label-for="input-13">
                          <b-form-input
                            id="input-20"
                            required
                            value=""
                            placeholder="Enter Latitude"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-13" label="Longitude:" label-for="input-13">
                          <b-form-input
                            id="input-13"
                            required
                            value=""
                            placeholder="Enter Longitude"
                          ></b-form-input>
                        </b-form-group>
                      </b-col> -->

                <legend><i class="fa fa-angle-right"></i> Modules</legend>

                      <b-col md="4">
                        <b-form-group id="input-group-14" label="Module Specific:" label-for="input-14">
                          <b-form-input
                            id="input-14"
                            required
                            value=""
                            placeholder="Enter Module Specific"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-15" label="Module ID:" label-for="input-15">
                          <b-form-input
                            id="input-15"
                            required
                            value=""
                            placeholder="Enter Module ID"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-16" label="Status:" label-for="input-16">
                          <b-form-select class="mb-3" id="input-16">
                            <option value="" selected disabled>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                          </b-form-select>
                        </b-form-group>
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

<script>
import Widget from 'RESO/js/components/Widget/Widget';

export default {
  name: 'Locations',
  components: { Widget },
  data() {
    return {
      message: 'Test message'
    }
  }
};
</script>

<style src="./Locations.scss" lang="scss" scoped />