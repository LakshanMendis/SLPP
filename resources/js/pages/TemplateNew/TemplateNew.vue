<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>New Template</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Template - <span class="fw-semi-bold">Create New</span>
    </h1>

    <b-row>
      <b-col lg="12">
        <Widget>
          <b-form name="form_main" id="form_main" @submit.stop.prevent="saveTemplate()" @reset.stop.prevent="resetAll()" novalidate>
          <b-row>
            <b-col md="6">
              <b-form-group id="gr-name" label="Template Name:" label-for="name">
                <b-form-input
                  id="name"
                  placeholder="Enter template name"
                  v-model="form_data.name"
                ></b-form-input>
              </b-form-group>
            </b-col>

            <b-col md="6">
              <b-form-group id="gr-language" label="Template Language:" label-for="language">
                <b-form-select
                  class="mb-1"
                  id="language"
                  name="language"
                  v-model="form_data.language"
                >
                  <option value="0" selected disabled>Select Language</option>
                  <option
                    v-for="data in languages"
                    :value="data.id"
                    :key="data.id"
                  >{{ data.language + " - " + data.caption }}</option>
                </b-form-select>
              </b-form-group>
            </b-col>
          </b-row>

          <b-row>
            <b-col md="6">
              <b-form-group id="gr-date" label="Date:" label-for="date">
                <b-form-input
                  type="date"
                  id="date"
                  placeholder="Enter template name"
                  v-model="form_data.date"
                ></b-form-input>
              </b-form-group>
            </b-col>

            <b-col md="6">
              <b-form-group id="gr-target" label="Target:" label-for="target">
                <b-form-select
                  class="mb-1"
                  id="target"
                  name="target"
                  v-model="form_data.target"
                >
                  <option value="" selected disabled>Select Target</option>
                  <option value="PAPER-A4">Paper: A4</option>
                  <option value="PAPER-LEGAL">Paper: Legal</option>
                  <option value="PAPER-LABELS">Paper: Labels</option>
                  <option value="PAPER-ENVELOPE">Paper: Envelope</option>
                  <option value="SMS">SMS</option>
                  <option value="WHATSAPP">WhatsApp</option>
                  <option value="EMAIL">E-Mail</option>
                </b-form-select>
              </b-form-group>
            </b-col>
          </b-row>

          <b-row>
            <b-col md=3 class="pt-4">
              <b-form-checkbox
                class="mb-3"
                id="is-base-template"
                v-model="form_data.is_base_template"
                name="is-base-template"
                :value="true"
                :unchecked-value="false"
              >
                Make this base template
              </b-form-checkbox>
            </b-col>

            <b-col md="3">
              <b-form-group id="gr-select-base-template" label="Select Base Template:" label-for="select-base-template">
                <b-form-select
                  class="mb-2"
                  id="select-base-template"
                  name="select-base-template"
                  :disabled="form_data.is_base_template"
                  v-model="form_data.select_base_template"
                >
                  <option
                    v-for="data in active_base_templates"
                    :value="data.id"
                    :key="data.id"
                  >{{ data.name + "/" + data.template_date + "/" + data.target }}</option>
                </b-form-select>
              </b-form-group>
            </b-col>

            <b-col md="6">
              <b-form-group id="gr-status" label="Status:" label-for="status">
                <b-form-select
                  class="mb-4"
                  id="status"
                  name="status"
                  v-model="form_data.status"
                >
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </b-form-select>
              </b-form-group>
            </b-col>
          </b-row>

          <ckeditor
            class="document-editor"
            :editor="editor"
            :config="editor_config"
            v-model="form_data.editor_data"
            @ready="onReady">
          </ckeditor>

          <div class="mt-4 clearfix">
            <div class="float-right">
              <b-button type="submit" variant="maroon" size="md"><i class="fa fa-check"></i> Save</b-button>
            </div>
            <div class="float-left">
              <b-button type="reset" variant="warning" size="md"><i class="fa fa-plus"></i> New</b-button>
            </div>
          </div>
          </b-form>
        </Widget>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import Widget from 'RESO/js/components/Widget/Widget';
import DecoupledEditor from '@ckeditor/ckeditor5-build-decoupled-document';
//import Mention from '@ckeditor/ckeditor5-mention';

/* In case you need to enable classic editor, un-comment following lines */
//import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
  name: 'TemplateNew',
  components: { 
    Widget
  },
  data() {
    return {
      current_date: '',
      languages: [],
      active_base_templates: [],
      editor: DecoupledEditor,
      editor_config: {
        /*plugins: [ Mention ],
        mention: {
          feeds: [
            {
              marker: '@',
              feed: [ 
                '@MEMBERSHIP_ID',
                '@TITLE',
                '@FIRST_NAME',
                '@LAST_NAME',
                '@CALLING_NAME',
                '@FULL_NAME',
                '@NIC',
                '@NATIONALITY',
                '@RELIGION'
              ],
              minimumCharacters: 1
            }
          ]
        }*/
      },
      form_data: {
        name: '',
        language: 0,
        date: this.current_date,
        target: '',
        is_base_template: true,
        select_base_template: 0,
        status: 1,
        editor_data: ''
      }
    }
  },
  methods: {
    all_languages() {
      window.axios.get('/api/languages').then(({ data }) => {
        this.languages = data;
      });
    },
    all_active_base_templates() {
      let para = { 'query': 'all-active-base' };

      window.axios.get('/api/templates', { params: para }).then(({ data }) => {
        this.active_base_templates = data;
      });
    },
    today() {
      this.current_date = new Date().toJSON().slice(0,10);
    },
    onReady(editor) {
      // Insert the toolbar before the editable area.
      editor.ui.getEditableElement().parentElement.insertBefore(
          editor.ui.view.toolbar.element,
          editor.ui.getEditableElement()
      );
    },
    saveTemplate() {
      window.axios.get('/api/templates/create', { params: this.form_data }).then(({ data }) => {
        if (data.id) {
          this.all_active_base_templates();
          this.$swal('Success', 'Template created successfully!!', 'success');
          this.resetAll();
        }
      });
    },
    resetAll() {
      this.form_data.name = "";
      this.form_data.language = 0;
      this.form_data.date = this.current_date;
      this.form_data.target = "";
      this.form_data.status = 1;
      this.form_data.editor_data = "";
    }
  },
  created() {
    this.all_languages();
    this.all_active_base_templates();
    this.today();
  }
};
</script>

<style src="./TemplateNew.scss" lang="scss" scoped />