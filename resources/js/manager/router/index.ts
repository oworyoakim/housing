import {createRouter, createWebHistory, RouteRecordRaw} from "vue-router";

const routes: Array<RouteRecordRaw> = [
    {
        path: '/manager',
        component: () => import(/* webpackChunkName: "manager" */ '@/manager/components/Container.vue'),
        children: [
            {
                path: '',
                name: 'manager',
                redirect: {name: 'manager-dashboard'}
            },
            {
                path: 'settings',
                name: 'manager-settings',
                // route level code-splitting
                // this generates a separate chunk (manager-settings.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () => import(/* webpackChunkName: "manager-settings" */ '@/manager/components/Settings/Index.vue'),
                children: [
                    {
                        path: '',
                        redirect: {name: 'amenities-settings'},
                    },
                    {
                        path: 'amenities',
                        name: 'amenities-settings',
                        component: import(/* webpackChunkName: "manager-settings" */ '@/manager/components/Amenities/List.vue'),
                    },
                    {
                        path: 'bed-types',
                        name: 'bed-types-settings',
                        component: import(/* webpackChunkName: "manager-settings" */ '@/manager/components/BedTypes/List.vue'),
                    },
                    {
                        path: 'room-or-service-categories',
                        name: 'room-or-service-categories-settings',
                        component: import(/* webpackChunkName: "manager-settings" */ '@/manager/components/RoomCategories/List.vue'),
                    },
                ]
            },
            {
                path: 'dashboard',
                name: 'manager-dashboard',
                // route level code-splitting
                // this generates a separate chunk (dashboard.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () => import(/* webpackChunkName: "dashboard" */ '@/manager/components/Dashboard/Index.vue')
            },
            {
                path: 'properties',
                name: 'manager-properties',
                // route level code-splitting
                // this generates a separate chunk (properties.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () => import(/* webpackChunkName: "properties" */ '@/manager/components/Properties/Index.vue'),
                children: [
                    {
                        path: '',
                        name: 'manager-properties-list',
                        component: () => import(/* webpackChunkName: "properties" */'@/manager/components/Properties/List.vue'),
                        meta: {
                            title: "Manage Properties"
                        }
                    },
                    {
                        path: 'edit/:id?',
                        name: 'manager-properties-edit',
                        component: () => import(/* webpackChunkName: "properties" */'@/manager/components/Properties/PropertyForm.vue'),
                        meta: {
                            title: "Property Form"
                        }
                    },
                    {
                        path: ':id',
                        name: 'manager-properties-details',
                        component: () => import(/* webpackChunkName: "properties" */'@/manager/components/Properties/PropertyDetails.vue'),
                        meta: {
                            title: "Manage Property"
                        }
                    },
                    {
                        path: ':id/rooms-or-services',
                        name: 'manager-properties-rooms-or-services',
                        component: () => import(/* webpackChunkName: "properties" */'@/manager/components/Rooms/RoomsOrServices.vue'),
                        meta: {
                            title: "Manage Property Rooms/Services"
                        }
                    },
                    {
                        path: ':propertyId/rooms-or-services/edit/:id?',
                        name: 'manager-properties-rooms-edit',
                        component: () => import(/* webpackChunkName: "properties" */'@/manager/components/Rooms/RoomForm.vue'),
                        meta: {
                            title: "Room/Service Form"
                        }
                    },
                    {
                        path: ':propertyId/rooms-or-services/:id',
                        name: 'manager-properties-rooms-details',
                        component: () => import(/* webpackChunkName: "properties" */'@/manager/components/Rooms/RoomDetails.vue'),
                        meta: {
                            title: "Manage Room/Service"
                        }
                    },
                ],
            },
            {
                path: 'reservations',
                name: 'manager-reservations',
                // route level code-splitting
                // this generates a separate chunk (reservations.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () => import(/* webpackChunkName: "reservations" */ '@/manager/components/ExampleComponent.vue'),
                children: [],
            },
            {
                path: 'profile',
                name: 'manager-profile',
                // route level code-splitting
                // this generates a separate chunk (profile.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () => import(/* webpackChunkName: "profile" */ '@/manager/components/ExampleComponent.vue'),
                children: [],
            },
        ]
    },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.meta && to.meta.title) {
        // @ts-ignore
        document.title = to.meta.title || "Housing";
    }
    next();
});

export default router;
