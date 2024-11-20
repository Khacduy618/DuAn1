import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig({
  plugins: [vue()],
  // base: 'DuAn1/Admin/MVC/Views/admin_view_long/vue-app/dist/',
  // base: '/du-an-voi-team/DuAn1-19-11/DuAn1/Admin/MVC/Views/admin_view_long/vue-app/dist/',
  base: '/du-an-voi-team/DuAn1-19-11/DuAn1/Admin/MVC/Views/admin_view_long/vue-app/dist/',
  build: {
    outDir: 'dist',
    assetsDir: 'assets',
    emptyOutDir: true,
    rollupOptions: {
      output: {
        manualChunks: undefined,
        entryFileNames: 'assets/[name].js',
        chunkFileNames: 'assets/[name].js',
        assetFileNames: 'assets/[name].[ext]'
      }
    }
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './src')
    }
  },
  server: {
    cors: true,
    headers: {
      'Access-Control-Allow-Origin': '*'
    }
  }
}) 