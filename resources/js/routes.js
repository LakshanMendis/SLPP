import Vue from 'vue';
import VueRouter from 'vue-router';

import Layout from 'RESO/js/components/Layout/Layout';

/* Guide Pages */
import Typography from 'RESO/js/pages/Typography/Typography';
import Tables from 'RESO/js/pages/Tables/Tables';
import Notifications from 'RESO/js/pages/Notifications/Notifications';
import Icons from 'RESO/js/pages/Icons/Icons';
import Maps from 'RESO/js/pages/Maps/Maps';
import Charts from 'RESO/js/pages/Charts/Charts';
import Dashboard from 'RESO/js/pages/Dashboard/Dashboard';
import Login from 'RESO/js/pages/Login/Login';
import ErrorPage from 'RESO/js/pages/Error/Error';
import AnotherPage from 'RESO/js/pages/AnotherPage/AnotherPage';

/* Member Pages */
import MemberView from 'RESO/js/pages/MemberView/MemberView';
import MemberNew from 'RESO/js/pages/MemberNew/MemberNew';
import MemberUpdate from 'RESO/js/pages/MemberUpdate/MemberUpdate';
import MemberTagging from 'RESO/js/pages/MemberTagging/MemberTagging';

/* Templating Pages */
import TemplateView from 'RESO/js/pages/TemplateView/TemplateView';
import TemplateNew from 'RESO/js/pages/TemplateNew/TemplateNew';
import TemplateUpdate from 'RESO/js/pages/TemplateUpdate/TemplateUpdate';
import TemplatePosting from 'RESO/js/pages/TemplatePosting/TemplatePosting';

Vue.use(VueRouter);

const routes = [
    {
        path: '/login',
        name: 'Login',
        component: Login,
    },
    {
        path: '/error',
        name: 'Error',
        component: ErrorPage,
    },
    {
        path: '/app',
        name: 'Layout',
        component: Layout,
        children: [
            {
                path: 'dashboard',
                name: 'Dashboard',
                component: Dashboard,
            },
            {
                path: 'member/view',
                name: 'View Member',
                component: MemberView,
            },
            {
                path: 'member/new',
                name: 'New Member',
                component: MemberNew,
            },
            {
                path: 'member/update-inactive',
                name: 'Update or Inactive Member',
                component: MemberUpdate,
            },
            {
                path: 'member/tagging',
                name: 'Tag Members',
                component: MemberTagging,
            },
            {
                path: 'templating/view',
                name: 'View Template',
                component: TemplateView,
            },
            {
                path: 'templating/new',
                name: 'New Template',
                component: TemplateNew,
            },
            {
                path: 'templating/update-inactive',
                name: 'Update or Inactive Template',
                component: TemplateUpdate,
            },
            {
                path: 'templating/posting',
                name: 'Posting',
                component: TemplatePosting,
            },
            {
                path: 'guide/typography',
                name: 'Typography',
                component: Typography,
            },
            {
                path: 'guide/tables',
                name: 'Tables',
                component: Tables,
            },
            {
                path: 'guide/notifications',
                name: 'Notifications',
                component: Notifications,
            },
            {
                path: 'guide/blank',
                name: 'Blank',
                component: AnotherPage,
            },
            {
                path: 'guide/icons',
                name: 'Icons',
                component: Icons,
            },
            {
                path: 'guide/maps',
                name: 'Maps',
                component: Maps,
            },
            {
                path: 'guide/charts',
                name: 'Charts',
                component: Charts,
            },
        ],
    },
    {
        path: '*',
        name: 'Error',
        component: ErrorPage,
    }
];

const router = new VueRouter({ mode: 'history', routes: routes });

export default router;