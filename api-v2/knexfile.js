// Update with your config settings.

module.exports = {

  development: {
    client: 'pg',
    connection: {
      host     : '127.0.0.1',
      post     : '5432',
      user     : 'postgres',
      password : 'kliment',
      database : 'finance'
    },
    pool: {
      min: 2,
      max: 10
    },
    migrations: {
      directory: 'db/migrations',
      tableName: 'knex_migrations'
    }
  },
  developmentTrade: {
    client: 'pg',
    connection: {
      host     : '127.0.0.1',
      post     : '5432',
      user     : 'postgres',
      password : 'kliment',
      database : 'finance'
    },
    pool: {
      min: 1
    },
    migrations: {
      directory: 'db/migrations/trade',
      tableName: 'knex_migrations'
    }
  },

  staging: {
    client: 'postgresql',
    connection: {
      database: 'my_db',
      user:     'username',
      password: 'password'
    },
    pool: {
      min: 2,
      max: 10
    },
    migrations: {
      tableName: 'knex_migrations'
    }
  },

  production: {
    client: 'postgresql',
    connection: {
      client: 'pg',
      connection: {
        host     : '127.0.0.1',
        post     : '5432',
        user     : 'postgres',
        password : 'kliment',
        database : 'finance'
      }
    },
    pool: {
      min: 2,
      max: 10
    },
    migrations: {
      tableName: 'knex_migrations'
    }
  }

};
