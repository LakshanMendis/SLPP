<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>Modules</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Master - <span class="fw-semi-bold">Modules</span>
    </h1>

    <b-row>
      <b-col lg="12">
        <Widget>

        <b-form id="formPersonal" @submit.stop.prevent="submitPersonal()">
        <b-row>
                      <b-col md="6">
                        <b-form-group id="input-group-1" label="Code:" label-for="input-1">
                          <b-form-input
                            id="input-1"
                            required
                            value=""
                            placeholder="Enter Code"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-2" label="*Name:" label-for="input-2">
                          <b-form-input
                            id="input-2"
                            required
                            value=""
                            placeholder="Enter Name"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-3" label="Url:" label-for="input-3">
                          <b-form-input
                            id="input-3"
                            required
                            value=""
                            placeholder="Enter url"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-4" label="Internal menu Url:" label-for="input-4">
                          <b-form-input
                            id="input-4"
                            required
                            value=""
                            placeholder="Enter internal menu url"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-5" label="Icon:" label-for="input-5">
                          <b-form-input
                            id="input-5"
                            required
                            value=""
                            placeholder="Select Icon"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-6" label="Main Module:" label-for="input-6">
                          <b-form-select class="mb-3" id="input-4">
                            <option value="" selected disabled>Select Main Module</option>
                            <option value="female">Module 1</option>
                            <option value="male">Module 2</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-7" label="Parent Module Code:" label-for="input-7">
                          <b-form-select class="mb-3" id="input-7">
                            <option value="" selected disabled>Select Parent Module</option>
                            <option value="female">Module 1</option>
                            <option value="male">Module 2</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                     <b-col md="6">
                        <b-form-group id="input-group-8" label="Is in menu:" label-for="input-8">
                          <b-form-select class="mb-3" id="input-8">
                            <option value="" selected disabled>Select</option>
                            <option value="female">menu 1</option>
                            <option value="male">menu 2</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-9" label="Menu Level:" label-for="input-9">
                          <b-form-select class="mb-3" id="input-9">
                            <option value="" selected disabled>Select Menu Level</option>
                            <option value="female">Level 1</option>
                            <option value="male">Level 2</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-10" label="Status:" label-for="input-10">
                          <b-form-select class="mb-3" id="input-10">
                            <option value="" selected disabled>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="3">
                      <b-form-checkbox
                        id="checkbox-1"
                        v-model="status"
                        name="checkbox-1"
                        value="accepted"
                        unchecked-value="not_accepted"
                      >
                        Openable
                      </b-form-checkbox>
                      </b-col>

                      <b-col md="3">
                      <b-form-checkbox
                        id="checkbox-2"
                        v-model="status"
                        name="checkbox-2"
                        value="accepted"
                        unchecked-value="not_accepted"
                      >
                        Is in Menu
                      </b-form-checkbox>
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
  name: 'Modules',
  components: { Widget },
  data() {
    return {
      message: 'Test message'
    }
  }
};
</script>
