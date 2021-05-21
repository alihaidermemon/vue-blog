import BlogAdd from './components/blog/add.vue';
import BlogEdit from './components/blog/edit.vue';
import BlogList from './components/blog/list.vue';
import PageNotFound from './components/PageNotFound.vue';

export const routes = [
    {
        path: '/',
        component: BlogList,
    },
    {
        path: '/blog/add',
        component: BlogAdd
    },
    {
        name: 'blog/edit',
        path: '/blog/edit/:id',
        component: BlogEdit
    },
    { path: "*", component: PageNotFound }
];