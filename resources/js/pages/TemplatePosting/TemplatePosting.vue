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
          <form-wizard step-size="sm" title="Post Wizard" subtitle="Follow steps to send or schedule mail campaign!">
            <tab-content title="Media">
              <b-form-group label="Select media to distribute">
                <b-form-checkbox-group
                  v-model="selected"
                  :options="options"
                  switches
                  stacked
                ></b-form-checkbox-group>
              </b-form-group>

              <hr />

              <b-row>
                <b-col md="4">
                  <b-form-group label="SMS Sender ID:">
                    <b-form-select class="mb-3" >
                      <option value="SENDER1">SENDER1</option>
                      <option value="SENDER2">SENDER2</option>
                    </b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="4">
                  <b-form-group label="E-Mail Sender:">
                    <b-form-select class="mb-3" >
                      <option value="sender1@domain.com">sender1@domain.com</option>
                      <option value="sender2@domain.com">sender2@domain.com</option>
                    </b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="4">
                  <b-form-group label="From Address:">
                    <b-form-select class="mb-3" >
                      <option value="1">Head office</option>
                      <option value="2">Kurunegala Branch</option>
                    </b-form-select>
                  </b-form-group>
                </b-col>
              </b-row>
            </tab-content>
            <tab-content title="Audience">
              <h5>Electoral</h5><hr />

              <b-row>
                <b-col md="12">
                  <b-row>
                    <b-col md="4">
                      <b-form-group id="input-group-14" label="Province:" label-for="input-14">
                        <b-form-select class="mb-3" id="input-14">
                          <option value="1">Western</option>
                          <option value="2">Southern</option>
                          <option value="3">Central</option>
                          <option value="4">Nothern</option>
                          <option value="5">Uva</option>
                          <option value="6">Sabaragamuwa</option>
                          <option value="7">North Western</option>
                        </b-form-select>
                      </b-form-group>
                    </b-col>

                    <b-col md="4">
                      <b-form-group id="input-group-15" label="District:" label-for="input-15">
                        <b-form-select class="mb-3" id="input-14">
                          <option value="1">Colombo</option>
                          <option value="2">Gampaha</option>
                          <option value="3">Matara</option>
                          <option value="4">Galle</option>
                          <option value="5">Anuradhapura</option>
                          <option value="6">Polonnaruwa</option>
                          <option value="7">Kurunegala</option>
                        </b-form-select>
                      </b-form-group>
                    </b-col>

                    <b-col md="4">
                      <b-form-group id="input-group-16" label="Electorate:" label-for="input-16">
                        <b-form-select class="mb-3" id="input-16">
                          <option value="1">Electorate 1</option>
                        </b-form-select>
                      </b-form-group>
                    </b-col>
                  </b-row>

                  <b-row>
                    <b-col md="4">
                      <b-form-group id="input-group-17" label="Local Authority:" label-for="input-17">
                        <b-form-select class="mb-3" id="input-17">
                          <option value="1">Local Authority 1</option>
                        </b-form-select>
                      </b-form-group>
                    </b-col>

                    <b-col md="4">
                      <b-form-group id="input-group-18" label="Ward:" label-for="input-18">
                        <b-form-select class="mb-3" id="input-18">
                          <option value="1">WARD 1</option>
                        </b-form-select>
                      </b-form-group>
                    </b-col>

                    <b-col md="4">
                      <b-form-group id="input-group-19" label="GN Division:" label-for="input-19">
                        <b-form-select class="mb-3" id="input-19">
                          <option value="1">GN Division 1</option>
                        </b-form-select>
                      </b-form-group>
                    </b-col>
                  </b-row>
                </b-col>
              </b-row>

              <h5>Category</h5><hr />

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
            </tab-content>
            <tab-content title="Message">
              <b-row>
                <b-col md="6">
                  <b-form-group label="Select Template:">
                    <b-form-select class="mb-3" >
                      <option value="0">Template 1</option>
                      <option value="1">Template 2</option>
                    </b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group label="Language Option:">
                    <b-form-select class="mb-3" >
                      <option value="Automatic">Automatic</option>
                      <option value="en">English</option>
                      <option value="si">Sinhala</option>
                      <option value="ta">Tamil</option>
                    </b-form-select>
                  </b-form-group>
                </b-col>
              </b-row>
            </tab-content>
            <tab-content title="Send">
              <p class="text-info">Click <strong>Finish</strong> to proceed or exit to cancel!</p>
            </tab-content>
          </form-wizard>
        </Widget>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import Widget from 'RESO/js/components/Widget/Widget';
import {FormWizard, TabContent} from 'vue-form-wizard';
import 'vue-form-wizard/dist/vue-form-wizard.min.css';

export default {
  name: 'AnotherPage',
  components: { 
    Widget,
    FormWizard,
    TabContent
  },
  data() {
    return {
      selected: [], // Must be an array reference!
      options: [
        { text: 'Printed', value: 'printed' },
        { text: 'SMS', value: 'sms' },
        { text: 'E-mail', value: 'email' }
      ]
    }
  }
};
</script>
