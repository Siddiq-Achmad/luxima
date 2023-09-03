export default [
  { heading: 'Master Data' },
  
  {
    title: 'Form Layouts',
    icon: { icon: 'tabler-layout-navbar' },
    to: 'forms-form-layouts',
  },
  {
    title: 'Form Validation',
    icon: { icon: 'tabler-checkbox' },
    to: 'forms-form-validation',
  },
  {
    title: 'Data Master',
    icon: { icon: 'tabler-table' },
    children: [
      { title: 'Data User', to: 'tables-simple-table' },
      { title: 'Data Karyawan', to: 'tables-data-table' },
    ],
  },
]
