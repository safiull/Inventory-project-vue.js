
export const routes = [
  { 
  	path: '/', 
  	component: require('./components/auth/login.vue').default,
    name: '/',
  },
  { 
  	path: '/register', 
  	component: require('./components/auth/register.vue').default,
    name: 'register',
  },
  { 
  	path: '/forget', 
  	component: require('./components/auth/forget.vue').default,
  },
  { 
    path: '/home', 
    component: require('./components/home.vue').default,
    name: 'home',
  },
  {
    path: '/logout',
    component: require('./components/auth/logout.vue').default,
    name: 'logout',
  },
  {
    path: '/store-employee',
    component: require('./components/employee/addNewEmployee.vue').default,
    name: 'store-employee',
  },
  {
    path: '/all-employee',
    component: require('./components/employee/allEmployeeList.vue').default,
    name: 'all-employee',
  },
  {
    path: '/edit-employee/:id',
    component: require('./components/employee/editEmployee.vue').default,
    name: 'edit-employee',
  },
  {
    path: '/store-supplier',
    component: require('./components/supplier/addNewSupplier.vue').default,
    name: 'store-supplier',
  },
  {
    path: '/all-supplier',
    component: require('./components/supplier/allSupplierList.vue').default,
    name: 'all-supplier',
  },
  {
    path: '/edit-supplier/:id',
    component: require('./components/supplier/editSupplier.vue').default,
    name: 'edit-supplier',
  },
  {
    path: '/store-category',
    component: require('./components/category/addNewCategory.vue').default,
    name: 'store-category',
  },
  {
    path: '/all-category',
    component: require('./components/category/allCategoryList.vue').default,
    name: 'all-category',
  },
  {
    path: '/edit-category/:id',
    component: require('./components/category/editCategory.vue').default,
    name: 'edit-category',
  },
  {
    path: '/store-product',
    component: require('./components/product/addNewProduct.vue').default,
    name: 'store-product',
  },
  {
    path: '/all-product',
    component: require('./components/product/allProductList.vue').default,
    name: 'all-product',
  },
  {
    path: '/edit-product/:id',
    component: require('./components/product/editProduct.vue').default,
    name: 'edit-product',
  },
  {
    path: '/store-expense',
    component: require('./components/expense/addNewExpense.vue').default,
    name: 'store-expense',
  },
  {
    path: '/all-expense',
    component: require('./components/expense/allExpenseList.vue').default,
    name: 'all-expense',
  },
  {
    path: '/edit-expense/:id',
    component: require('./components/expense/editExpense.vue').default,
    name: 'edit-expense',
  },

  // Salary module
  {
    path: '/pay-salary',
    component: require('./components/salary/paySalary.vue').default,
    name: 'pay-salary',
  },
  {
    path: '/all-salary',
    component: require('./components/salary/allSalary.vue').default,
    name: 'all-salary',
  },
  {
    path: '/give-salary/:id',
    component: require('./components/salary/giveSalary.vue').default,
    name: 'give-salary',
  },
  {
    path: '/view-salary/:id',
    component: require('./components/salary/viewSalary.vue').default,
    name: 'view-salary',
  },
  {
    path: '/pos',
    component: require('./components/pos/pos.vue').default,
    name: 'pos',
  },

  // { 
  //   path: '/reset-password', 
  //   name: 'reset-password', 
  //   component: require('./components/auth/ForgotPassword.vue').default, 
  //   meta: { 
  //     auth:false 
  //   } 
  // },
  // { 
  //   path: '/reset-password/:token', 
  //   name: 'reset-password-form', 
  //   component: require('./components/auth/ResetPasswordForm.vue').default, 
  //   meta: { 
  //     auth:false 
  //   } 
  // }

]