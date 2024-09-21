import Profile from '../pages/Profile.vue';
import Statistic from '../pages/Statistic.vue';
import Referrals from '../pages/Referrals.vue';
import Settings from '../pages/Settings.vue';

const routes = [
    {
        path: '/profile',
        name: 'Profile',
        component: Profile,
    },

    {
        path: '/statistic',
        name: 'Statistic',
        component: Statistic,
    },

    {
        path: '/referrals',
        name: 'Referrals',
        component: Referrals,
    },

    {
        path: '/settings',
        name: 'Settings',
        component: Settings,
    },
];
export default routes;
