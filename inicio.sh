#!/bin/bash
set -e

psql -U postgres <<-EOSQL
	CREATE DATABASE northwind;
    CREATE DATABASE dellstore;
EOSQL

psql -U postgres -d northwind -f /tmp/northwind_dump
psql -U postgres -d dellstore -f /tmp/dellstore_dump