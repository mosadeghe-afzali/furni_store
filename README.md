# فروشگاه مبلمان - Furni Store

پروژه  برای مدیریت محصولات، سفارشات و پرداخت‌های یک فروشگاه آنلاین مبلمان، ساخته شده با Laravel و PostgreSQL.



## روش اجرای پروژه

پروژه با استفاده از Docker راه‌اندازی می‌شود. پیش‌نیاز اجرای آن نصب Docker و Docker Compose است.

### نصب و راه‌اندازی

۱. مخزن پروژه را کلون کنید:

```bash
git clone <repository-url>
cd furni-store
```

۲. فایل `.env` را از نمونه بسازید و مقادیر دیتابیس را تنظیم کنید:

```bash
cp .env.example .env
```
۳. کانتینرها را بالا بیاورید:

```bash
docker compose up -d
```

۴. وابستگی‌ها را نصب کنید:

```bash
docker compose exec app composer install
```

۵. کلید اپلیکیشن را بسازید:

```bash
docker compose exec app php artisan key:generate
```
## رش اجرای Migration‌ها

برای ایجاد ساختار دیتابیس، دستور زیر را اجرا کنید:

```bash
docker compose exec app php artisan migrate


## روش ایجاد داده نمونه
برای پر کردن دیتابیس با داده‌های نمونه، از سیدرها استفاده می‌شود:

```bash
docker compose exec app php artisan db:seed

برای اجرای مجدد از ابتدا:

```bash
docker compose exec app php artisan migrate:fresh --seed

## روش اجرای تست‌ها

```bash
docker compose exec app php artisan test


## روش اجرای تست‌ها

```bash
docker compose exec app php artisan test
```


### سرویس‌ها

| سرویس | نام کانتینر | پورت |
|-------|-------------|------|
| Nginx | furni_store_nginx | `localhost:8000` |
| PHP-FPM | furni-store | ۹۰۰۰ |
| PostgreSQL | furni_store_postgres | `5432` |

### دستورات کاربردی

```bash
# اجرای سرور توسعه
docker compose exec app php artisan serve

# دسترسی به شل Laravel
docker compose exec app php artisan tinker
---

## ساختار کلی پروژه

```
app/
├── Http/
│   ├── Controllers/          # کنترلرهای API
│   │   ├── ProductController.php
│   │   ├── OrderController.php
│   │   └── PaymentController.php
│   ├── Requests/             # اعتبارسنجی درخواست‌ها
│   │   ├── ProductIndexRequest.php
│   │   ├── SubmitOrderRequest.php
│   │   └── OrderPaymentCallbackRequest.php
│   └── Resources/            # تبدیل مدل‌ها به JSON
│       ├── ProductResource.php
│       ├── ProductCollection.php
│       ├── ProductVariantResource.php
│       ├── AttributeValueResource.php
│       └── MediaResource.php
├── Models/                   # مدل‌های Eloquent
├── Services/                 # لایه سرویس (منطق تجاری)
│   ├── ProductService.php
│   ├── OrderService.php
│   └── PaymentSerice.php
├── Repositories/             # لایه دسترسی به دیتابیس
│   ├── ProductRepository.php
│   ├── productVariantRepository.php
│   ├── OrderRepository.php
│   └── PaymentRepository.php
├── Traits/
│   └── ResponseTrait.php     # پاسخ استاندارد API
├── Enums/
│   └── OrderStatusEnum.php   # وضعیت‌های سفارش
database/
├── migrations/               # ۱۴ فایل مایگریشن
├── seeders/                  # ۸ سیدر
tests/
├── Feature/                  # تست‌های فیچر
└── Unit/                     # تست‌های یونیت
```

### الگوی معماری

پروژه از الگوی **Service-Repository** استفاده می‌کند:

```
Request → Controller → Service → Repository → Eloquent Model
```

- **کنترلر**: دریافت درخواست و فراخوانی سرویس
- **سرویس**: اجرای منطق تجاری و مدیریت تراکنش‌ها
- **ریپازیتوری**: تعامل مستقیم با دیتابیس
- **Resource**: تبدیل خروجی مدل‌ها به فرمت JSON مناسب API

---

## مدل دیتابیس

### نمودار ارتباطات

```
Category ──1:N──> Product
Product ──1:N──> ProductVariant
ProductVariant ──N:M──> AttributeValue (از طریق variant_attribute_values)
Product ──MorphMany──> Media
ProductVariant ──MorphMany──> Media
Product ──1:N──> OrderItem
ProductVariant ──1:N──> OrderItem
Order ──1:N──> OrderItem
Order ──1:N──> Payment
User ──1:N──> Order
```

### جدول محصولات و تنوع‌ها

محصولات دارای ساختار درختی دسته‌بندی هستند (`parent_id`). هر محصول می‌تواند تنوع‌های مختلفی داشته باشد (مثلاً رنگ‌ها و سایزهای مختلف). هر تنوع قیمت و موجودی مستقل خود را دارد.

### جدول ویژگی‌ها

ویژگی‌ها (Attribute) شامل رنگ، جنس، سایز و... هستند. هر ویژگی مقادیر مختلفی دارد (مثلاً ویژگی «رنگ» مقادیر «قرمز»، «آبی» و... دارد). ارتباط بین تنوع محصول و مقادیر ویژگی‌ها از طریق جدول واسط `variant_attribute_values` برقرار می‌شود.

### جدول رسانه‌ها

رسانه‌ها از رابطه Polymorphic استفاده می‌کنند تا هم برای محصولات و هم برای تنوع‌ها قابل استفاده باشند.

### جدول سفارشات و پرداخت

هر سفارش شامل یک یا چند آیتم است و وضعیت‌های مختلفی دارد (در حال پرداخت، موفق، لغو شده). پرداخت‌ها با شماره تراکنش و مرجع ردیابی می‌شوند و مهلت ۲۰ دقیقه‌ای برای تکمیل دارند.


## فرضیات انجام شده

1. **نیاز به احراز هویت نیست**: فعلاً اندپوینت‌های اصلی بدون احراز هویت در دسترس هستند (به جز `/api/user`). در نسخه نهایی باید میدل‌ور احراز هویت اضافه شود.

2. **پرداخت واقعی نیست**: سیستم پرداخت شبیه‌سازی شده و فقط وضعیت موفق/ناموفق را دریافت می‌کند. اتصال به درگاه پرداخت واقعی باید جداگانه پیاده‌سازی شود.

3. **قیمت‌ها به تومان هستند**: تمامی قیمت‌ها و مبالغ به تومان ذخیره می‌شوند.

4. **ساختار دسته‌بندی درختی است**: دسته‌بندی‌ها می‌توانند زیردسته داشته باشند (۲ سطح در داده‌های نمونه).

5. **هر محصول حداقل یک تنوع دارد**: بدون تنوع، محصول قابل سفارش نیست.

6. **مدیریت موجودی خودکار است**: موجودی تنوع‌ها هنگام ثبت سفارش کاهش و هنگام لغو پرداخت برگردانده می‌شود.

7. **پاسخ‌های API به صورت استاندارد هستند**: تمام پاسخ‌ها شامل فیلدهای `success`, `message` و `response` هستند.

---

## محدودیت‌های پیاده‌سازی

1. **احراز هویت**: فعلاً فقط توکن‌های Sanctum تنظیم شده‌اند ولی میدل‌ور احراز هویت روی اندپوینت‌ها اعمال نشده است.

2. **پرداخت واقعی**: درگاه پرداخت متصل نیست و فقط وضعیت شبیه‌سازی شده دریافت می‌شود.

3. **مدیریت فایل**: آپلود تصاویر و مدیریت فایل‌های رسانه‌ای پیاده‌سازی نشده و فعلاً فقط URLهای خارجی پشتیبانی می‌شوند.



---

## پیشنهادات برای مقیاس بزرگ‌تر

-توسعه بخش احراز هویت
- کامل کردن سفارش باگرفتن اطلاعات نحوه پرداخت، ادرس کاربر و ...
- تعریف فروشگاه های ارائه دهنده محصولات
-امکان ثب نظر و امتیاز برای محصولات
- استفاده از cashing مثل redis برای افزایش کاهش درخواست به دیتابیس
- در مقیاس خیلی بزرگ استفاده از elasticsearch  برای جستجو های سریع و منعطف
- پیاده سازی پنل مدیریت محصولات


