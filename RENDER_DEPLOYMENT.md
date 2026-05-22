# Laravel on Render 部署指南

## 🚀 快速部署步骤

### 1. 推送到 GitHub
```bash
cd D:\laragon\www\ms2
git init
git add .
git commit -m "Initial commit for Render deployment"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/ms2.git
git push -u origin main
```

### 2. 在 Render 上部署
1. 访问 https://render.com 并注册/登录
2. 点击 "New +" → "Web Service"
3. 连接你的 GitHub 仓库
4. Render 会自动检测 `render.yaml` 配置

### 3. 环境变量配置
在 Render Dashboard 中设置：
- `APP_KEY`: 会自动生成
- `APP_ENV`: production
- `APP_DEBUG`: false

### 4. 数据库迁移
Render 会在部署时自动运行 `php artisan migrate --force`

## ⚠️ 重要注意事项

### Render 免费套餐限制：
- ⏸️ **15 分钟无活动后会休眠**（下次访问需要 30-60 秒唤醒）
- 💾 **文件系统是临时的**（每次部署会重置，除了持久化磁盘）
- 🐘 **PostgreSQL 免费套餐：1GB 存储**
- 🌐 **带宽限制：100GB/月**

### 需要修改的代码：
由于 Render 的文件系统是临时的，你需要：
1. **图片上传** → 使用云存储（Cloudinary / AWS S3）
2. **SQLite → PostgreSQL**（已在 `render.yaml` 中配置）
3. **Session** → 使用 database 或 redis（已在配置中）

## 🔧 故障排查

### 查看日志：
在 Render Dashboard → Logs 查看实时日志

### 常见问题：
1. **部署失败**：检查 `composer.lock` 是否存在
2. **数据库错误**：确保 PostgreSQL 服务已创建
3. **500 错误**：查看 Logs，通常是权限问题

## 📝 后续优化建议

1. **添加持久化磁盘**（付费 $10/月）存储上传文件
2. **使用 Cloudinary** 免费方案处理图片（25 credits/月）
3. **升级到付费套餐**（$7/月）避免休眠

## 🔗 相关链接
- Render 文档：https://render.com/docs
- Laravel on Render：https://render.com/docs/deploy-laravel
