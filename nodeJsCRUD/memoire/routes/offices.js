/*
 * GET officess listing.
 */
exports.list = function (req, res) {
    req.getConnection(function (err, connection) {

        connection.query('SELECT * FROM offices', function (err, rows) {

            if (err)
                console.log("Error Selecting : %s ", err);

            res.render('offices', {page_title: "Offices - Node.js", data: rows});

        });

    });

};
exports.add = function (req, res) {
    res.render('add_offices', {page_title: "Add Offices-Node.js"});
};
exports.edit = function (req, res) {

    var officeCode = req.params.officeCode;

    req.getConnection(function (err, connection) {

        connection.query('SELECT * FROM offices WHERE officeCode = ?', [officeCode], function (err, rows)
        {

            if (err)
                console.log("Error Selecting : %s ", err);

            res.render('edit_offices', {page_title: "Edit Offices - Node.js", data: rows});

        });

    });
};
/*Save the offices*/
exports.save = function (req, res) {

    var input = JSON.parse(JSON.stringify(req.body));

    req.getConnection(function (err, connection) {

        var data = {
            city: input.city,
            phone: input.phone,
            addressLine1: input.addressLine1,
            state: input.state,
            country: input.country,
            postalCode: input.postalCode,
            territory: input.territory,
            
        };

        var query = connection.query("INSERT INTO offices set ? ", data, function (err, rows)
        {

            if (err)
                console.log("Error inserting : %s ", err);

            res.redirect('/offices');

        });

        // console.log(query.sql); get raw query

    });
};/*Save edited offices*/
exports.save_edit = function (req, res) {

    var input = JSON.parse(JSON.stringify(req.body));
    var officeCode = req.params.officeCode;

    req.getConnection(function (err, connection) {

        var data = {
            city: input.city,
            phone: input.phone,
            addressLine1: input.addressLine1,
            state: input.state,
            country: input.country,
            postalCode: input.postalCode,
            territory: input.territory,

        };

        connection.query("UPDATE offices set ? WHERE officeCode = ? ", [data, officeCode], function (err, rows)
        {

            if (err)
                console.log("Error Updating : %s ", err);

            res.redirect('/offices');

        });

    });
};

exports.delete_offices = function (req, res) {

    var officeCode = req.params.officeCode;

    req.getConnection(function (err, connection) {

        connection.query("DELETE FROM offices  WHERE officeCode = ? ", [officeCode], function (err, rows)
        {

            if (err)
                console.log("Error deleting : %s ", err);

            res.redirect('/offices');

        });

    });
};