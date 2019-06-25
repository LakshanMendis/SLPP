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
                  <b-form-group id="input-group-1" label="Membership ID:" label-for="input-1">
                    <b-form-input
                      id="input-1"
                      placeholder="Member ID"
                    ></b-form-input>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group id="input-group-2" label="Name (Like):" label-for="input-2">
                    <b-form-input
                      id="input-2"
                      placeholder="Member name"
                    ></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>

              <b-row>
                <b-col md="6">
                  <b-form-group id="input-group-7" label="Nationality:" label-for="input-7">
                    <b-form-select class="mb-3" id="input-7">
                      <option value="Sinhala">Sinhala</option>
                      <option value="Hindu">Hindu</option>
                      <option value="Muslim">Muslim</option>
                      <option value="Other">Other</option>
                    </b-form-select>
                  </b-form-group>
                </b-col>

                <b-col md="6">
                  <b-form-group id="input-group-8" label="Religion:" label-for="input-8">
                    <b-form-select class="mb-3" id="input-8">
                      <option value="Buddhist">Buddhist</option>
                      <option value="Christian">Christian</option>
                      <option value="Hindu">Hindu</option>
                      <option value="Islamic">Islamic</option>
                      <option value="Other">Other</option>
                    </b-form-select>
                  </b-form-group>
                </b-col>
              </b-row>
            </b-tab>

            <b-tab title="Electoral">
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
            </b-tab>

            <b-tab title="Category">
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
            </b-tab>
          </b-tabs>

          <div class="mt-3 clearfix">
            <div class="float-right">
              <b-button variant="maroon" size="md"><i class="fa fa-search"></i> Search</b-button>
            </div>
            <div class="float-left">
              <b-button variant="primary" size="md"><i class="fa fa-undo"></i> Reset</b-button>
            </div>
          </div>
        </Widget>
        
        <Widget>
          <div class="table-resposive widget-table-overflow">
            <table class="table" id="member-table">
              <thead>
                <tr>
                  <th class="hidden-sm-down">#</th>
                  <th>Picture</th>
                  <th>Name</th>
                  <th class="hidden-sm-down">Categories</th>
                  <th class="hidden-sm-down">Electoral</th>
                  <th class="hidden-sm-down">Mobile</th>
                  <th class="hidden-sm-down">Status</th>
                  <th class="hidden-sm-down">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="row in tableStyles" :key="row.id">
                  <td>{{row.id}}</td>
                  <td>
                    <img class="img-rounded" :src="row.picture" alt="" height="50" />
                  </td>
                  <td>
                    {{row.name}}
                    <div v-if="row.label">
                      <b-badge :variant="row.label.colorClass">{{row.label.text}}</b-badge>
                    </div>
                  </td>
                  <td>
                    <p class="mb-0">
                      <small>
                        <span class="fw-semi-bold">Type:</span>
                        <span class="text-muted">&nbsp; {{row.cat.type}}</span>
                      </small>
                    </p>
                    <p>
                      <small>
                        <span class="fw-semi-bold">Profession:</span>
                        <span class="text-muted">&nbsp; {{row.cat.profession}}</span>
                      </small>
                    </p>
                  </td>
                  <td>
                    <p class="mb-0">
                      <small>
                        <span class="fw-semi-bold">Province:</span>
                        <span class="text-muted">&nbsp; {{row.elec.province}}</span>
                      </small>
                    </p>
                    <p class="mb-0">
                      <small>
                        <span class="fw-semi-bold">District:</span>
                        <span class="text-muted">&nbsp; {{row.elec.district}}</span>
                      </small>
                    </p>
                    <p>
                      <small>
                        <span class="fw-semi-bold">Electorate:</span>
                        <span class="text-muted">&nbsp; {{row.elec.electorate}}</span>
                      </small>
                    </p>
                  </td>
                  <td class="text-semi-bold">
                    {{row.mobile}}
                  </td>
                  <td class="text-semi-bold">
                    {{row.status}}
                  </td>
                  <td class="width-150" align="center">
                    <b-button size="sm" variant="maroon" v-b-modal.modal-1><i class="fa fa-search"></i></b-button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="clearfix">
            <div class="float-right">
              <b-pagination
                :total-rows="5"
                :per-page="1"
                aria-controls="member-table"
              ></b-pagination>
            </div>
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

export default {
  name: 'AnotherPage',
  components: { Widget },
  data() {
    return {
      tableStyles: [
        {
          id: 1,
          picture: require('../../assets/people/a1.jpg'), // eslint-disable-line global-require
          name: 'Soe Jane',
          label: {
            colorClass: 'secondary',
            text: 'Tag1, Tag2',
          },
          cat: {
            type: 'Parliament',
            profession: 'Doctor',
          },
          elec: {
            province: 'Western',
            district: 'Gampaha',
            electorate: 'Kelaniya',
          },
          status: 'Active',
          mobile: '0776447552',
        },
        {
          id: 2,
          picture: require('../../assets/people/a2.jpg'), // eslint-disable-line global-require
          name: 'Jenny Jones',
          label: {
            colorClass: 'secondary',
            text: '',
          },
          cat: {
            type: 'Provincial',
            profession: 'Lawyer',
          },
          elec: {
            province: 'Western',
            district: 'Colombo',
            electorate: 'Maradana',
          },
          status: 'Active',
          mobile: '0712346540',
        },
        {
          id: 3,
          picture: require('../../assets/people/a3.jpg'), // eslint-disable-line global-require
          name: 'Sierra Banks',
          label: {
            colorClass: 'secondary',
            text: 'Tag1, Tag2, Tag3, Tag4',
          },
          cat: {
            type: 'Local Authority',
            profession: 'Lawyer',
          },
          elec: {
            province: 'Southern',
            district: 'Matara',
            electorate: 'Beliatta',
          },
          status: 'Active',
          mobile: '0774662890',
        },
        {
          id: 4,
          picture: require('../../assets/people/a4.jpg'), // eslint-disable-line global-require
          name: 'Daniel Rutherford',
          label: {
            colorClass: 'secondary',
            text: 'Tag1',
          },
          cat: {
            type: 'SLPP Union',
            profession: 'Enterprenuer',
          },
          elec: {
            province: 'North Western',
            district: 'Dambulla',
            electorate: 'Galgamuwa',
          },
          status: 'Active',
          mobile: '0753427494',
        },
        {
          id: 5,
          picture: require('../../assets/people/a5.jpg'), // eslint-disable-line global-require
          name: 'Joe John',
          label: {
            colorClass: 'secondary',
            text: 'Tag2, Tag3',
          },
          cat: {
            type: 'Party Member',
            profession: 'Engineer',
          },
          elec: {
            province: 'Western',
            district: 'Gampaha',
            electorate: 'Delgoda',
          },
          status: 'Active',
          mobile: '0776336558',
        },
      ],
    };
  },
};
</script>
