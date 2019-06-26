import 'package:flutter/material.dart';

void main() => runApp (MyApp());
	class MyApp extends StatelessWidget{
	@override
	Widget build(BuildContext context) {
		return MaterialApp(
			title: "User profile",
			debugShowCheckedModeBanner: false,
			home: UserProfilePage(),
		);
	}

	}

	class UserProfilePage extends StatelessWidget {
			final String _name = "Roxy";
			final String _breed = "Terrier";
			final String _bio = "\" is a super nice dog and loves playing. She is interesting in playing and cuddeling and she loves  other dogs.\"";

			Widget _buildCoverImage() {
			return Container(
			height: 280,
			decoration: BoxDecoration(
			image: DecorationImage(
			image: AssetImage('assets/images/logo.jpg'),
			fit: BoxFit.cover
			)
			),
			);
			}
      Widget _buildName() {
        TextStyle _nameTextStyle = TextStyle(
          fontFamily: 'Montserrat',
          color: Colors.black,
          fontSize: 28.0,
          fontWeight: FontWeight.w700,
        );

        return Text(
          _name,
          style: _nameTextStyle,
        );

      }
      Widget _buildBreed(BuildContext context) {
        return Container(
          padding: EdgeInsets.symmetric(vertical: 4.0, horizontal: 10.0),
          decoration: BoxDecoration(
            color: Theme.of(context).scaffoldBackgroundColor,
            borderRadius: BorderRadius.circular(4.0),
          ),
          child: Text(
            _breed,
            style: TextStyle(
              fontFamily: 'Montserrat',
              color: Colors.black,
              fontSize: 20.0,
              fontWeight: FontWeight.w300,
            ),
          ),
        );
      }

      Widget _buildBio(BuildContext context) {
        TextStyle bioTextStyle = TextStyle(
          fontFamily: 'Montserrat',
          fontWeight: FontWeight.w400,//try changing weight to w500 if not thin
          color: Color(0xFF799497),
          fontSize: 16.0,
        );

        return Container(
          color: Theme.of(context).scaffoldBackgroundColor,
          padding: EdgeInsets.all(8.0),
          child: Text(
            _bio,
            textAlign: TextAlign.center,
            style: bioTextStyle,
          ),
        );
      }
      Widget _buildSeparator(Size screenSize) {
        return Container(
          width: screenSize.width / 1.1,
          height: 0.8,
          color: Colors.black54,
          margin: EdgeInsets.only(top: 4.0),
        );
      }
      Widget _buildGetInTouch(BuildContext context) {
        return Container(
          color: Theme.of(context).scaffoldBackgroundColor,
          padding: EdgeInsets.only(top: 8.0),
          child: Text(
            "Get in Touch with ${_name.split(" ")[0]},",
            style: TextStyle(fontFamily: 'Montserrat', fontSize: 16.0),
          ),
        );
      }

      Widget _buildButtons() {
        return Padding(
          padding: EdgeInsets.symmetric(vertical: 8.0, horizontal: 16.0),
          child: Row(
            children: <Widget>[
              Expanded(
                  child: Container(
                    height: 60.0,
                    width: 60.0,


                    child: Center(

                      child: new FloatingActionButton(
                        child: new Image.asset(
                          "assets/images/pen_change.png",
                          fit: BoxFit.fitWidth,
                          width: 40,
                          height: 40,
                        ),

                        onPressed: () => {},
                      ),

                    ),

                  ),

              ),
            ],
          ),
        );
      }


      @override
		Widget build(BuildContext context) {
			  Size screenSize = MediaQuery.of(context).size;
			return Scaffold(
          body: Stack(
            children: <Widget>[

              SafeArea(
                child: SingleChildScrollView(
                  child: Column(
                    children: <Widget>[
                      _buildCoverImage(),
                      SizedBox(height: screenSize.height / 50),

                      _buildName(),
                      _buildBreed(context),
                      _buildBio(context),
                      _buildSeparator(screenSize),
                      SizedBox(height: 10.0),
                      _buildGetInTouch(context),
                      SizedBox(height: 8.0),
                      _buildButtons(),
                    ],
                  ),
                ),
              ),
            ],
          )
      );
		}
	}

