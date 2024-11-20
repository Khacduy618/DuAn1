import SvgIcon from '@/components/SvgIcon/index.vue'
import * as ElementPlusIconsVue from '@element-plus/icons-vue'

export function loadPlugins(app) {
  // Register SvgIcon component globally
  app.component('svg-icon', SvgIcon)
  
  // Register all Element Plus Icons
  for (const [key, component] of Object.entries(ElementPlusIconsVue)) {
    app.component(key, component)
  }

  // Register global properties
  app.config.globalProperties.$filters = {
    // Add your global filters here
    formatDate: (value) => {
      if (!value) return ''
      return new Date(value).toLocaleDateString()
    }
  }

  // Register global directives
  app.directive('permission', {
    mounted(el, binding) {
      const { value } = binding
      const roles = store.getters && store.getters.roles

      if (value && value instanceof Array && value.length > 0) {
        const permissionRoles = value
        const hasPermission = roles.some(role => permissionRoles.includes(role))

        if (!hasPermission) {
          el.parentNode && el.parentNode.removeChild(el)
        }
      }
    }
  })
} 