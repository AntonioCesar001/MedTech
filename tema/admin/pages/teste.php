<!DOCTYPE html>
<html>
<head>
<title>TDB Form</title>
<style>
body {
  font-family: sans-serif;
}

.tdb-group {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.tdb-label {
  margin-right: 10px;
}

.tdb-input {
  margin-right: 10px;
}

.tdb-button {
  padding: 5px 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
  cursor: pointer;
}

.tdb-search {
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
  width: 100%;
}

.tdb-select {
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
  width: 100%;
  cursor: pointer;
}

.tdb-multi-search {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.tdb-multi-search-button {
  padding: 5px 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
  cursor: pointer;
  margin-right: 10px;
}

.tdb-unique-search {
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
  width: 100%;
}

.tdb-entry {
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
  width: 100%;
}
</style>
</head>
<body>

<div class="tdb-group">
  <div class="tdb-label">TDBRadioGroup:</div>
  <div class="tdb-input">
    <input type="radio" name="radio-group" value="frequente"> Frequente
    <input type="radio" name="radio-group" value="casual"> Casual
    <input type="radio" name="radio-group" value="varejista"> Varejista
  </div>
</div>

<div class="tdb-group">
  <div class="tdb-label">TDBCheckGroup:</div>
  <div class="tdb-input">
    <input type="checkbox" name="check-group" value="frequente"> Frequente
    <input type="checkbox" name="check-group" value="casual"> Casual
    <input type="checkbox" name="check-group" value="varejista" checked> Varejista
  </div>
</div>

<div class="tdb-group">
  <div class="tdb-label">TDBRadioGroup (use button):</div>
  <div class="tdb-input">
    <button class="tdb-button">1- Frequente</button>
    <button class="tdb-button">2- Casual</button>
    <button class="tdb-button">3- Varejista</button>
  </div>
</div>

<div class="tdb-group">
  <div class="tdb-label">TDBCheckGroup (use button):</div>
  <div class="tdb-input">
    <button class="tdb-button">1- Frequente</button>
    <button class="tdb-button">2- Casual</button>
    <button class="tdb-button">3- Varejista</button>
  </div>
</div>

<div class="tdb-group">
  <div class="tdb-label">TDBCombo:</div>
  <div class="tdb-input">
    <select class="tdb-search">
      <option value="casual">Casual</option>
    </select>
  </div>
</div>

<div class="tdb-group">
  <div class="tdb-label">TDBCombo (with search):</div>
  <div class="tdb-input">
    <select class="tdb-search">
      <option value="casual">Casual</option>
    </select>
  </div>
</div>

<div class="tdb-group">
  <div class="tdb-label">TDBSelect:</div>
  <div class="tdb-input">
    <select class="tdb-select">
      <option value="frequente">Frequente</option>
      <option value="casual">Casual</option>
      <option value="varejista">Varejista</option>
    </select>
  </div>
</div>

<div class="tdb-multi-search">
  <div class="tdb-label">TDBMultiSearch:</div>
  <div class="tdb-input">
    <button class="tdb-multi-search-button">× Frequente (1)</button>
    <button class="tdb-multi-search-button">× Casual (2)</button>
  </div>
</div>

<div class="tdb-group">
  <div class="tdb-label">TDBUniqueSearch:</div>
  <div class="tdb-input">
    <input type="text" class="tdb-unique-search" value="(2) Porto Alegre - RS">
  </div>
</div>

<div class="tdb-group">
  <div class="tdb-label">TDBEntry:</div>
  <div class="tdb-input">
    <input type="text" class="tdb-entry">
  </div>
</div>

</body>
</html>