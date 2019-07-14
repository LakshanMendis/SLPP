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
        name: 'login',
        component: Login,
    },
    {
        path: '/error',
        name: 'error',
        component: ErrorPage,
    },
    {
        path: '/app',
        name: 'app',
        component: Layout,
        children: [
            {
                path: 'dashboard',
                name: 'dashboard',
                component: Dashboard,
            },
            {
                path: 'member/view',
                name: 'memberView',
                component: MemberView,
            },
            {
                path: 'member/new',
                name: 'memberAddNew',
                component: MemberNew,
            },
            {
                path: 'member/update-inactive',
                name: 'memberUpdateInactive',
                component: MemberUpdate,
            },
            {
                path: 'member/tagging',
                name: 'memberTagging',
                component: MemberTagging,
            },
            {
                path: 'member/categories',
                name: 'memberCategories',
                component: Categories,
            },
            {
                path: 'templating/view',
                name: 'templatingView',
                component: TemplateView,
            },
            {
                path: 'templating/new',
                name: 'templatingCreateNew',
                component: TemplateNew,
            },
            {
                path: 'templating/update-inactive',
                name: 'templatingUpdateInac',
                component: TemplateUpdate,
            },
            {
                path: 'templating/posting',
                name: 'templatingPosting',
                component: TemplatePosting,
            },
            {
                path: 'guide/typography',
                name: 'guidesTypo',
                component: Typography,
            },
            {
                path: 'guide/tables',
                name: 'guidesTables',
                component: Tables,
            },
            {
                path: 'guide/notifications',
                name: 'guidesNotifications',
                component: Notifications,
            },
            {
                path: 'guide/blank',
                name: 'guidesBlank',
                component: AnotherPage,
            },
            {
                path: 'guide/icons',
                name: 'guidesIcons',
                component: Icons,
            },
            {
                path: 'guide/maps',
                name: 'guidesMaps',
                component: Maps,
            },
            {
                path: 'guide/charts',
                name: 'guidesCharts',
                component: Charts,
            },
            {
                path: 'admin/users',
                name: 'users',
                component: Users,
            },
            {
                path: 'admin/modules',
                name: 'modules',
                component: Modules,
            },
            {
                path: 'admin/permissions',
                name: 'permissions',
                component: Permissions,
            },
            {
                path: 'admin/companies',
                name: 'companies',
                component: Companies,
            },
            {
                path: 'admin/locations',
                name: 'locations',
                component: Locations,
            },
            {
                path: 'admin/departments',
                name: 'departments',
                component: Departments,
            },
            {
                path: 'admin/designations',
                name: 'designations',
                component: Designations,
            },
            {
                path: 'master/titles',
                name: 'titles',
                component: Titles,
            },
            {
                path: 'master/nationality',
                name: 'nationality',
                component: Nationality,
            },
            {
                path: 'master/religions',
                name: 'religions',
                component: Religions,
            },
            {
                path: 'master/provinces',
                name: 'provinces',
                component: Provinces,
            },
            {
                path: 'master/districts',
                name: 'districts',
                component: Districts,
            },
            {
                path: 'master/electorates',
                name: 'electorates',
                component: Electorates,
            },
            {
                path: 'master/localauthorities',
                name: 'localAuthorities',
                component: LocalAuthorities,
            },
            {
                path: 'master/wards',
                name: 'wards',
                component: Wards,
            },
            {
                path: 'master/gndivisions',
                name: 'gnDivisions',
                component: GNDivisions,
            },
            {
                path: 'reports/member',
                name: 'reports',
                component: MemberReport,
            },
            {
                path: 'reports/posting',
                name: 'reportsPostingLog',
                component: PostingReport,
            },
        ],
    },
    {
        path: '*',
        name: 'error',
        component: ErrorPage,
    }
];

const router = new VueRouter({ mode: 'history', routes: routes });

router.beforeEach((to, from, next) => {
    const access_id = window.localStorage.getItem('access_id');
    const to_index = to.name;

    const send_data = {
        'access_id' : access_id,
        'module_code' : to_index
    }

    if (to_index == 'login' || to_index == 'dashboard' || to_index == 'error'){
        next();
    } else {
        window.axios.post('/api/authenticate/check',send_data).then(({data}) => {
            if (data.result) {
                next();
            } else {
                next(false);
            }
        }).catch((e) => {
            next(false);
            console.error(e);
        });
    }
});

export default router;