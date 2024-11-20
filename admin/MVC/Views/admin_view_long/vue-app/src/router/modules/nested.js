export default {
  path: '/nested',
  component: () => import('@/layout/index.vue'),
  name: 'Nested',
  meta: {
    title: 'Nested Routes',
    icon: 'nested'
  },
  children: [
    {
      path: 'menu1',
      component: () => import('@/views/nested/menu1/index.vue'),
      name: 'Menu1',
      meta: { title: 'Menu 1' },
      children: [
        {
          path: 'menu1-1',
          component: () => import('@/views/nested/menu1/menu1-1/index.vue'),
          name: 'Menu1-1',
          meta: { title: 'Menu 1-1' }
        },
        {
          path: 'menu1-2',
          component: () => import('@/views/nested/menu1/menu1-2/index.vue'),
          name: 'Menu1-2',
          meta: { title: 'Menu 1-2' }
        }
      ]
    },
    {
      path: 'menu2',
      component: () => import('@/views/nested/menu2/index.vue'),
      name: 'Menu2',
      meta: { title: 'Menu 2' }
    }
  ]
} 