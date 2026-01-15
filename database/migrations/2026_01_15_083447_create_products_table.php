<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', static function (Blueprint $table) {
            $table->id();

            // Оставил LIKE индекс для простоты.
            // Я поизучал немного индексы строк: like, fts, trigram.
            // FTS тут не совсем подойдёт, потому что не сможет искать по части слова
            // Trigram тоже не подойдёт сейчас, потому что нужно настраивать
            $table->string('name')->index();

            $table->string('slug')->unique()->comment('Например, для ЧПУ');

            // Вместо decimal из ТЗ я использовал unsignedBigInteger и храню цену в копейках,
            // чтобы избежать ошибок при арифметических операциях с дробными числами в коде
            // но тут тоже зависит от подхода. есть пакеты для работы с деньгами.
            //я их тут решил не использовать и поэтому остановлюсь на uint
            // $table->decimal('price', 10, 2)->index();
            $table->unsignedBigInteger('price')->index();

            // Из этой связи ТЗ я делаю вывод, что у товара может быть только одна категория,
            // поэтому не меняю на связь Many-To-Many
            $table->foreignId('category_id')->nullable()->index()->constrained()->cascadeOnUpdate()->nullOnDelete();

            $table->boolean('in_stock')->default(true);
            $table->float('rating', 2)->index();

            $table->datetimes();
            $table->softDeletesDatetime();

            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
