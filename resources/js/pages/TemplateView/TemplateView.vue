<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>View Templates</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Template - <span class="fw-semi-bold">View</span>
    </h1>

    <b-row>
      <b-col lg="12">
        <Widget>
          <b-form name="form-view" id="form-view" @submit.stop.prevent="view_template" @reset.stop.prevent="clear_selection">
            <b-row>
              <b-col md="12">
                <b-form-group id="group_select_template" label="Template:" label-for="select_template">
                  <b-form-select
                    class="mb-3"
                    id="select_template"
                    name="select_template"
                    v-model="select_template"
                  >
                    <option value="" disabled>Select Template</option>
                    <option
                      v-for="data in templates"
                      :value="data.id"
                      :key="data.id"
                    >{{ data.name + "/" + data.template_date + "/" + data.target }}</option>
                  </b-form-select>
                </b-form-group>
              </b-col>
            </b-row>

            <div class="mt-2 clearfix">
              <div class="float-right">
                <b-button type="submit" variant="maroon" size="md"><i class="fa fa-check"></i> View</b-button>
              </div>
              <div class="float-left">
                <b-button type="reset" variant="warning" size="md"><i class="fa fa-plus"></i> New</b-button>
              </div>
            </div>
          </b-form>
        </Widget>
      </b-col>
    </b-row>

    <b-row v-if="document_view_enable">
      <b-col lg="12">
        <Widget>
          <b-row align-h="center">
            <b-col md="10" class="document-viewer" v-html="template_content">
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
  name: 'templateView',
  components: { Widget },
  data() {
    return {
      templates: [],
      select_template: "",
      document_view_enable: false,
      template_content: ""
    }
  },
  methods: {
    all_templates() {
      let para = { 'query': 'all' };

      window.axios.get('/api/templates', { params: para }).then(({ data }) => {
        this.templates = data;
      });
    },
    view_template (e) {
      const template_id = this.select_template;

      window.axios.get('/api/templates/'+template_id).then(({ data }) => {
        this.document_view_enable = true;
        this.template_content = data.content;
      });
    },
    clear_selection () {
      this.document_view_enable = false;
      this.select_template = "";
    }
  },
  created() {
    this.all_templates();
  }
};
</script>

<style src="./TemplateView.scss" lang="scss" scoped />