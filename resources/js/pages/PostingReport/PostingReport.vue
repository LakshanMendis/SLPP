<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>Posting Report</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Report - <span class="fw-semi-bold">Posting</span>
    </h1>

    <b-row>
      <b-col lg="12">
        <Widget>
          <b-row>
            <b-col md="6">
              <b-form-group id="gr-media" label="Media:" for="media">
                <b-form-select
                  id="media"
                  name="media"
                  v-model="filters.media"
                >
                </b-form-select>
              </b-form-group>
            </b-col>

            <b-col md="6">
              <b-form-group id="gr-template" label="Template:" for="template">
                <b-form-select
                  id="template"
                  name="template"
                  v-model="filters.template"
                >
                </b-form-select>
              </b-form-group>
            </b-col>
          </b-row>

          <b-row>
            <b-col md="6">
              <b-form-group id="gr-language" label="Language:" for="language">
                <b-form-select
                  id="language"
                  name="language"
                  v-model="filters.language"
                >
                </b-form-select>
              </b-form-group>
            </b-col>

            <b-col md="6">
              <b-form-group id="gr-date-range" label="Date Range:" for="date-range">
              </b-form-group>
            </b-col>
          </b-row>
        </Widget>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import Widget from 'RESO/js/components/Widget/Widget';

export default {
  name: 'PostingReport',
  components: { Widget },
  data() {
    return {
      filters: {
        media: '',
        template: ''
      }
    }
  }
};
</script>
