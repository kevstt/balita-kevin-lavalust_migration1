import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

export default defineConfig({
  base: '/product/',
  plugins: [react()],
  build: {
    outDir: '../public/product',
    emptyOutDir: true,
  },
  server: { host: '127.0.0.1', port: 5173 },
})