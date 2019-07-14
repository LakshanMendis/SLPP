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

/* Admin Pages */
import Users from 'RESO/js/pages/Users/Users';
import Modules from 'RESO/js/pages/Modules/Modules';
import Permissions from 'RESO/js/pages/Permissions/Permissions';
import Companies from 'RESO/js/pages/Companies/Companies';
import Locations from 'RESO/js/pages/Locations/Locations';
import Departments from 'RESO/js/pages/Departments/Departments';
import Designations from 'RESO/js/pages/Designations/Designations';

/* Master Pages */
import Titles from 'RESO/js/pages/Titles/Titles';
import Nationality from 'RESO/js/pages/Nationality/Nationality';
import Religions from 'RESO/js/pages/Religions/Religions';
import Provinces from 'RESO/js/pages/Provinces/Provinces';
import Districts from 'RESO/js/pages/Districts/Districts';
import Electorates from 'RESO/js/pages/Electorates/Electorates';
import LocalAuthorities from 'RESO/js/pages/LocalAuthorities/LocalAuthorities';
import Wards from 'RESO/js/pages/Wards/Wards';
import GNDivisions from 'RESO/js/pages/GNDivisions/GNDivisions';

/* Member Pages */
import MemberView from 'RESO/js/pages/MemberView/MemberView';
import MemberNew from 'RESO/js/pages/MemberNew/MemberNew';
import MemberUpdate from 'RESO/js/pages/MemberUpdate/MemberUpdate';
import MemberTagging from 'RESO/js/pages/MemberTagging/MemberTagging';
import Categories from 'RESO/js/pages/Categories/Categories';

/* Templating Pages */
import TemplateView from 'RESO/js/pages/TemplateView/TemplateView';
import TemplateNew from 'RESO/js/pages/TemplateNew/TemplateNew';
import TemplateUpdate from 'RESO/js/pages/TemplateUpdate/TemplateUpdate';
import TemplatePosting from 'RESO/js/pages/TemplatePosting/TemplatePosting';

/* Report Pages */
import MemberReport from 'RESO/js/pages/MemberReport/MemberReport';
import PostingReport from 'RESO/js/pages/PostingReport/PostingReport';

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
                path: 'member/categories',
                name: 'Categories',
                component: Categories,
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
            {
                path: 'admin/users',
                name: 'Users',
                component: Users,
            },
            {
                path: 'admin/modules',
                name: 'Modules',
                component: Modules,
            },
            {
                path: 'admin/permissions',
                name: 'Permissions',
                component: Permissions,
            },
            {
                path: 'admin/companies',
                name: 'Companies',
                component: Companies,
            },
            {
                path: 'admin/locations',
                name: 'Locations',
                component: Locations,
            },
            {
                path: 'admin/departments',
                name: 'Departments',
                component: Departments,
            },
            {
                path: 'admin/designations',
                name: 'Designations',
                component: Designations,
            },
            {
                path: 'master/titles',
                name: 'Titles',
                component: Titles,
            },
            {
                path: 'master/nationality',
                name: 'Nationality',
                component: Nationality,
            },
            {
                path: 'master/religions',
                name: 'Religions',
                component: Religions,
            },
            {
                path: 'master/provinces',
                name: 'Provinces',
                component: Provinces,
            },
            {
                path: 'master/districts',
                name: 'Districts',
                component: Districts,
            },
            {
                path: 'master/electorates',
                name: 'Electorates',
                component: Electorates,
            },
            {
                path: 'master/localauthorities',
                name: 'LocalAuthorities',
                component: LocalAuthorities,
            },
            {
                path: 'master/wards',
                name: 'Wards',
                component: Wards,
            },
            {
                path: 'master/gndivisions',
                name: 'GNDivisions',
                component: GNDivisions,
            },
            {
                path: 'reports/member',
                name: 'MemberReport',
                component: MemberReport,
            },
            {
                path: 'reports/posting',
                name: 'PostingReport',
                component: PostingReport,
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

router.beforeEach((to, from, next) => {
    const access_id = window.localStorage.getItem('access_id');

    console.log('Checking permission to access '+to+' from '+from+' for access id: '+access_id);

    next();
});

export default router;