import { defineConfig } from 'vite';
import { resolve } from 'node:path';

export default defineConfig({
  build: {
    outDir: 'dist',
    emptyOutDir: true,
    rollupOptions: {
      input: resolve(import.meta.dirname, 'index.html'),
      output: {
        entryFileNames: 'assets/inventory.js',
        assetFileNames: 'assets/[name][extname]',
      },
    },
  },
});