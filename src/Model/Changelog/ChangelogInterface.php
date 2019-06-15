<?php

namespace App\Model\Changelog;

//Реализовать интерфейс:
interface ChangelogInterface
{
    public function getCurrentTag(); // Получить последнюю по дате версию
    public function getChangelog(); // Получить многомерный ассоц. массив для передачи в шаблонизатор, при этом изменив формат даты на d.m.Y
}

/* Для обработки файла вида:
<?xml version="1.0" encoding="utf-8"?>
<changelog>
	<release tag="0.1.0" date="2016-02-18">
		<update>Feature 1</update>
		<update>Feature 2</update>
		<update>Feature 3</update>
	</release>
	<release tag="0.0.0" date="2016-02-11">
		<update>Core</update>
	</release>
	<release tag="0.0.1" date="2016-02-14">
		<update>Core fix</update>
	</release>
</changelog> */