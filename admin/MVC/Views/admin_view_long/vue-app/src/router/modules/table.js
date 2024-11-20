export default {
  path: '/table',
  component: () => import('@/layout/index.vue'),
  name: 'Table',
  meta: {
    title: 'Table',
    icon: 'table'
  },
  children: [
    {
      path: 'dynamic-table',
      component: () => import('@/views/table/dynamic-table/index.vue'),
      name: 'DynamicTable',
      meta: { title: 'Dynamic Table' }
    }
  ]
} 