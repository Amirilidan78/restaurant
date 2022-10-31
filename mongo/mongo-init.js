var db = connect("mongodb://localhost/admin");
db.createUser(
    {
        user: "db_user",
        pwd: "db_pass",
        roles: [
            {
                role: "readWrite",
                db: "db"
            }
        ]
    }
);
