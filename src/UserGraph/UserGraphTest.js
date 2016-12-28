import React, { Component } from 'react';
import UserGraph from './UserGraph';

class UserGraphTest extends Component {

	render(){
		let dummyData = {
			graphSizes: {
				user: {
					height: 300,
					width: 900
				}
			},
			userColors: {
				brian: '#fff',
				daniel: '#fff',
				jacob: '#fff',
				mat: '#fff'
			},
			allScores: this.allScores()
		}
		return (
			<div className="container">
				<div className="row">
					<div className="col-xs-12">
						<UserGraph {...dummyData} />
					</div>
				</div>
			</div>
		);
	}

	allScores(){
		return(
			[
			    {
			        "name": "brian",
			        "data": [
			            {
			                "date": "2016-10-27",
			                "score": 172,
			                "day": 0
			            },
			            {
			                "date": "2016-10-28",
			                "score": 233,
			                "day": 1
			            },
			            {
			                "date": "2016-10-29",
			                "score": 230,
			                "day": 2
			            },
			            {
			                "date": "2016-10-30",
			                "score": 232,
			                "day": 3
			            },
			            {
			                "date": "2016-10-31",
			                "score": 217,
			                "day": 4
			            },
			            {
			                "date": "2016-11-01",
			                "score": 248,
			                "day": 5
			            },
			            {
			                "date": "2016-11-02",
			                "score": 265,
			                "day": 6
			            },
			            {
			                "date": "2016-11-03",
			                "score": 268,
			                "day": 7
			            },
			            {
			                "date": "2016-11-04",
			                "score": 252,
			                "day": 8
			            },
			            {
			                "date": "2016-11-05",
			                "score": 285,
			                "day": 9
			            },
			            {
			                "date": "2016-11-06",
			                "score": 283,
			                "day": 10
			            },
			            {
			                "date": "2016-11-07",
			                "score": 254,
			                "day": 11
			            },
			            {
			                "date": "2016-11-08",
			                "score": 273,
			                "day": 12
			            },
			            {
			                "date": "2016-11-09",
			                "score": 258,
			                "day": 13
			            },
			            {
			                "date": "2016-11-10",
			                "score": 224,
			                "day": 14
			            },
			            {
			                "date": "2016-11-11",
			                "score": 260,
			                "day": 15
			            },
			            {
			                "date": "2016-11-12",
			                "score": 273,
			                "day": 16
			            },
			            {
			                "date": "2016-11-13",
			                "score": 274,
			                "day": 17
			            },
			            {
			                "date": "2016-11-14",
			                "score": 275,
			                "day": 18
			            },
			            {
			                "date": "2016-11-15",
			                "score": 272,
			                "day": 19
			            },
			            {
			                "date": "2016-11-16",
			                "score": 238,
			                "day": 20
			            },
			            {
			                "date": "2016-11-17",
			                "score": 219,
			                "day": 21
			            },
			            {
			                "date": "2016-11-18",
			                "score": 256,
			                "day": 22
			            },
			            {
			                "date": "2016-11-19",
			                "score": 250,
			                "day": 23
			            },
			            {
			                "date": "2016-11-20",
			                "score": 252,
			                "day": 24
			            },
			            {
			                "date": "2016-11-21",
			                "score": 268,
			                "day": 25
			            },
			            {
			                "date": "2016-11-22",
			                "score": 249,
			                "day": 26
			            },
			            {
			                "date": "2016-11-23",
			                "score": 268,
			                "day": 27
			            },
			            {
			                "date": "2016-11-24",
			                "score": 268,
			                "day": 28
			            },
			            {
			                "date": "2016-11-25",
			                "score": 303,
			                "day": 29
			            },
			            {
			                "date": "2016-11-26",
			                "score": 303,
			                "day": 30
			            },
			            {
			                "date": "2016-11-27",
			                "score": 270,
			                "day": 31
			            },
			            {
			                "date": "2016-11-28",
			                "score": 285,
			                "day": 32
			            },
			            {
			                "date": "2016-11-29",
			                "score": 285,
			                "day": 33
			            },
			            {
			                "date": "2016-11-30",
			                "score": 289,
			                "day": 34
			            },
			            {
			                "date": "2016-12-01",
			                "score": 319,
			                "day": 35
			            },
			            {
			                "date": "2016-12-02",
			                "score": 303,
			                "day": 36
			            },
			            {
			                "date": "2016-12-03",
			                "score": 286,
			                "day": 37
			            },
			            {
			                "date": "2016-12-04",
			                "score": 285,
			                "day": 38
			            },
			            {
			                "date": "2016-12-05",
			                "score": 286,
			                "day": 39
			            },
			            {
			                "date": "2016-12-06",
			                "score": 301,
			                "day": 40
			            },
			            {
			                "date": "2016-12-07",
			                "score": 286,
			                "day": 41
			            },
			            {
			                "date": "2016-12-08",
			                "score": 302,
			                "day": 42
			            },
			            {
			                "date": "2016-12-09",
			                "score": 268,
			                "day": 43
			            },
			            {
			                "date": "2016-12-10",
			                "score": 268,
			                "day": 44
			            },
			            {
			                "date": "2016-12-11",
			                "score": 266,
			                "day": 45
			            },
			            {
			                "date": "2016-12-12",
			                "score": 277,
			                "day": 46
			            },
			            {
			                "date": "2016-12-13",
			                "score": 278,
			                "day": 47
			            },
			            {
			                "date": "2016-12-14",
			                "score": 245,
			                "day": 48
			            },
			            {
			                "date": "2016-12-15",
			                "score": 247,
			                "day": 49
			            },
			            {
			                "date": "2016-12-16",
			                "score": 249,
			                "day": 50
			            },
			            {
			                "date": "2016-12-17",
			                "score": 264,
			                "day": 51
			            },
			            {
			                "date": "2016-12-18",
			                "score": 263,
			                "day": 52
			            },
			            {
			                "date": "2016-12-19",
			                "score": 279,
			                "day": 53
			            },
			            {
			                "date": "2016-12-20",
			                "score": 261,
			                "day": 54
			            },
			            {
			                "date": "2016-12-21",
			                "score": 261,
			                "day": 55
			            },
			            {
			                "date": "2016-12-22",
			                "score": 261,
			                "day": 56
			            },
			            {
			                "date": "2016-12-23",
			                "score": 261,
			                "day": 57
			            },
			            {
			                "date": "2016-12-24",
			                "score": 280,
			                "day": 58
			            },
			            {
			                "date": "2016-12-25",
			                "score": 281,
			                "day": 59
			            },
			            {
			                "date": "2016-12-26",
			                "score": 279,
			                "day": 60
			            },
			            {
			                "date": "2016-12-27",
			                "score": 279,
			                "day": 61
			            }
			        ]
			    },
			    {
			        "name": "jacob",
			        "data": [
			            {
			                "date": "2016-10-27",
			                "score": 232,
			                "day": 0
			            },
			            {
			                "date": "2016-10-28",
			                "score": 268,
			                "day": 1
			            },
			            {
			                "date": "2016-10-29",
			                "score": 219,
			                "day": 2
			            },
			            {
			                "date": "2016-10-30",
			                "score": 252,
			                "day": 3
			            },
			            {
			                "date": "2016-10-31",
			                "score": 218,
			                "day": 4
			            },
			            {
			                "date": "2016-11-01",
			                "score": 266,
			                "day": 5
			            },
			            {
			                "date": "2016-11-02",
			                "score": 278,
			                "day": 6
			            },
			            {
			                "date": "2016-11-03",
			                "score": 247,
			                "day": 7
			            },
			            {
			                "date": "2016-11-04",
			                "score": 220,
			                "day": 8
			            },
			            {
			                "date": "2016-11-05",
			                "score": 230,
			                "day": 9
			            },
			            {
			                "date": "2016-11-06",
			                "score": 235,
			                "day": 10
			            },
			            {
			                "date": "2016-11-07",
			                "score": 241,
			                "day": 11
			            },
			            {
			                "date": "2016-11-08",
			                "score": 239,
			                "day": 12
			            },
			            {
			                "date": "2016-11-09",
			                "score": 260,
			                "day": 13
			            },
			            {
			                "date": "2016-11-10",
			                "score": 276,
			                "day": 14
			            },
			            {
			                "date": "2016-11-11",
			                "score": 249,
			                "day": 15
			            },
			            {
			                "date": "2016-11-12",
			                "score": 265,
			                "day": 16
			            },
			            {
			                "date": "2016-11-13",
			                "score": 264,
			                "day": 17
			            },
			            {
			                "date": "2016-11-14",
			                "score": 234,
			                "day": 18
			            },
			            {
			                "date": "2016-11-15",
			                "score": 251,
			                "day": 19
			            },
			            {
			                "date": "2016-11-16",
			                "score": 247,
			                "day": 20
			            },
			            {
			                "date": "2016-11-17",
			                "score": 284,
			                "day": 21
			            },
			            {
			                "date": "2016-11-18",
			                "score": 254,
			                "day": 22
			            },
			            {
			                "date": "2016-11-19",
			                "score": 305,
			                "day": 23
			            },
			            {
			                "date": "2016-11-20",
			                "score": 322,
			                "day": 24
			            },
			            {
			                "date": "2016-11-21",
			                "score": 289,
			                "day": 25
			            },
			            {
			                "date": "2016-11-22",
			                "score": 276,
			                "day": 26
			            },
			            {
			                "date": "2016-11-23",
			                "score": 228,
			                "day": 27
			            },
			            {
			                "date": "2016-11-24",
			                "score": 228,
			                "day": 28
			            },
			            {
			                "date": "2016-11-25",
			                "score": 297,
			                "day": 29
			            },
			            {
			                "date": "2016-11-26",
			                "score": 281,
			                "day": 30
			            },
			            {
			                "date": "2016-11-27",
			                "score": 342,
			                "day": 31
			            },
			            {
			                "date": "2016-11-28",
			                "score": 355,
			                "day": 32
			            },
			            {
			                "date": "2016-11-29",
			                "score": 355,
			                "day": 33
			            },
			            {
			                "date": "2016-11-30",
			                "score": 307,
			                "day": 34
			            },
			            {
			                "date": "2016-12-01",
			                "score": 337,
			                "day": 35
			            },
			            {
			                "date": "2016-12-02",
			                "score": 338,
			                "day": 36
			            },
			            {
			                "date": "2016-12-03",
			                "score": 339,
			                "day": 37
			            },
			            {
			                "date": "2016-12-04",
			                "score": 354,
			                "day": 38
			            },
			            {
			                "date": "2016-12-05",
			                "score": 354,
			                "day": 39
			            },
			            {
			                "date": "2016-12-06",
			                "score": 338,
			                "day": 40
			            },
			            {
			                "date": "2016-12-07",
			                "score": 352,
			                "day": 41
			            },
			            {
			                "date": "2016-12-08",
			                "score": 352,
			                "day": 42
			            },
			            {
			                "date": "2016-12-09",
			                "score": 307,
			                "day": 43
			            },
			            {
			                "date": "2016-12-10",
			                "score": 338,
			                "day": 44
			            },
			            {
			                "date": "2016-12-11",
			                "score": 373,
			                "day": 45
			            },
			            {
			                "date": "2016-12-12",
			                "score": 327,
			                "day": 46
			            },
			            {
			                "date": "2016-12-13",
			                "score": 324,
			                "day": 47
			            },
			            {
			                "date": "2016-12-14",
			                "score": 356,
			                "day": 48
			            },
			            {
			                "date": "2016-12-15",
			                "score": 323,
			                "day": 49
			            },
			            {
			                "date": "2016-12-16",
			                "score": 307,
			                "day": 50
			            },
			            {
			                "date": "2016-12-17",
			                "score": 303,
			                "day": 51
			            },
			            {
			                "date": "2016-12-18",
			                "score": 287,
			                "day": 52
			            },
			            {
			                "date": "2016-12-19",
			                "score": 290,
			                "day": 53
			            },
			            {
			                "date": "2016-12-20",
			                "score": 292,
			                "day": 54
			            },
			            {
			                "date": "2016-12-21",
			                "score": 306,
			                "day": 55
			            },
			            {
			                "date": "2016-12-22",
			                "score": 293,
			                "day": 56
			            },
			            {
			                "date": "2016-12-23",
			                "score": 293,
			                "day": 57
			            },
			            {
			                "date": "2016-12-24",
			                "score": 324,
			                "day": 58
			            },
			            {
			                "date": "2016-12-25",
			                "score": 323,
			                "day": 59
			            },
			            {
			                "date": "2016-12-26",
			                "score": 277,
			                "day": 60
			            },
			            {
			                "date": "2016-12-27",
			                "score": 277,
			                "day": 61
			            }
			        ]
			    },
			    {
			        "name": "mat",
			        "data": [
			            {
			                "date": "2016-10-27",
			                "score": 224,
			                "day": 0
			            },
			            {
			                "date": "2016-10-28",
			                "score": 211,
			                "day": 1
			            },
			            {
			                "date": "2016-10-29",
			                "score": 268,
			                "day": 2
			            },
			            {
			                "date": "2016-10-30",
			                "score": 286,
			                "day": 3
			            },
			            {
			                "date": "2016-10-31",
			                "score": 224,
			                "day": 4
			            },
			            {
			                "date": "2016-11-01",
			                "score": 281,
			                "day": 5
			            },
			            {
			                "date": "2016-11-02",
			                "score": 250,
			                "day": 6
			            },
			            {
			                "date": "2016-11-03",
			                "score": 250,
			                "day": 7
			            },
			            {
			                "date": "2016-11-04",
			                "score": 217,
			                "day": 8
			            },
			            {
			                "date": "2016-11-05",
			                "score": 243,
			                "day": 9
			            },
			            {
			                "date": "2016-11-06",
			                "score": 242,
			                "day": 10
			            },
			            {
			                "date": "2016-11-07",
			                "score": 265,
			                "day": 11
			            },
			            {
			                "date": "2016-11-08",
			                "score": 285,
			                "day": 12
			            },
			            {
			                "date": "2016-11-09",
			                "score": 267,
			                "day": 13
			            },
			            {
			                "date": "2016-11-10",
			                "score": 249,
			                "day": 14
			            },
			            {
			                "date": "2016-11-11",
			                "score": 319,
			                "day": 15
			            },
			            {
			                "date": "2016-11-12",
			                "score": 318,
			                "day": 16
			            },
			            {
			                "date": "2016-11-13",
			                "score": 318,
			                "day": 17
			            },
			            {
			                "date": "2016-11-14",
			                "score": 285,
			                "day": 18
			            },
			            {
			                "date": "2016-11-15",
			                "score": 297,
			                "day": 19
			            },
			            {
			                "date": "2016-11-16",
			                "score": 253,
			                "day": 20
			            },
			            {
			                "date": "2016-11-17",
			                "score": 251,
			                "day": 21
			            },
			            {
			                "date": "2016-11-18",
			                "score": 301,
			                "day": 22
			            },
			            {
			                "date": "2016-11-19",
			                "score": 298,
			                "day": 23
			            },
			            {
			                "date": "2016-11-20",
			                "score": 303,
			                "day": 24
			            },
			            {
			                "date": "2016-11-21",
			                "score": 316,
			                "day": 25
			            },
			            {
			                "date": "2016-11-22",
			                "score": 297,
			                "day": 26
			            },
			            {
			                "date": "2016-11-23",
			                "score": 300,
			                "day": 27
			            },
			            {
			                "date": "2016-11-24",
			                "score": 300,
			                "day": 28
			            },
			            {
			                "date": "2016-11-25",
			                "score": 319,
			                "day": 29
			            },
			            {
			                "date": "2016-11-26",
			                "score": 304,
			                "day": 30
			            },
			            {
			                "date": "2016-11-27",
			                "score": 235,
			                "day": 31
			            },
			            {
			                "date": "2016-11-28",
			                "score": 264,
			                "day": 32
			            },
			            {
			                "date": "2016-11-29",
			                "score": 247,
			                "day": 33
			            },
			            {
			                "date": "2016-11-30",
			                "score": 266,
			                "day": 34
			            },
			            {
			                "date": "2016-12-01",
			                "score": 265,
			                "day": 35
			            },
			            {
			                "date": "2016-12-02",
			                "score": 280,
			                "day": 36
			            },
			            {
			                "date": "2016-12-03",
			                "score": 248,
			                "day": 37
			            },
			            {
			                "date": "2016-12-04",
			                "score": 247,
			                "day": 38
			            },
			            {
			                "date": "2016-12-05",
			                "score": 229,
			                "day": 39
			            },
			            {
			                "date": "2016-12-06",
			                "score": 226,
			                "day": 40
			            },
			            {
			                "date": "2016-12-07",
			                "score": 227,
			                "day": 41
			            },
			            {
			                "date": "2016-12-08",
			                "score": 244,
			                "day": 42
			            },
			            {
			                "date": "2016-12-09",
			                "score": 225,
			                "day": 43
			            },
			            {
			                "date": "2016-12-10",
			                "score": 212,
			                "day": 44
			            },
			            {
			                "date": "2016-12-11",
			                "score": 210,
			                "day": 45
			            },
			            {
			                "date": "2016-12-12",
			                "score": 242,
			                "day": 46
			            },
			            {
			                "date": "2016-12-13",
			                "score": 223,
			                "day": 47
			            },
			            {
			                "date": "2016-12-14",
			                "score": 223,
			                "day": 48
			            },
			            {
			                "date": "2016-12-15",
			                "score": 204,
			                "day": 49
			            },
			            {
			                "date": "2016-12-16",
			                "score": 204,
			                "day": 50
			            },
			            {
			                "date": "2016-12-17",
			                "score": 205,
			                "day": 51
			            },
			            {
			                "date": "2016-12-18",
			                "score": 205,
			                "day": 52
			            },
			            {
			                "date": "2016-12-19",
			                "score": 223,
			                "day": 53
			            },
			            {
			                "date": "2016-12-20",
			                "score": 207,
			                "day": 54
			            },
			            {
			                "date": "2016-12-21",
			                "score": 206,
			                "day": 55
			            },
			            {
			                "date": "2016-12-22",
			                "score": 207,
			                "day": 56
			            },
			            {
			                "date": "2016-12-23",
			                "score": 207,
			                "day": 57
			            },
			            {
			                "date": "2016-12-24",
			                "score": 205,
			                "day": 58
			            },
			            {
			                "date": "2016-12-25",
			                "score": 207,
			                "day": 59
			            },
			            {
			                "date": "2016-12-26",
			                "score": 207,
			                "day": 60
			            },
			            {
			                "date": "2016-12-27",
			                "score": 207,
			                "day": 61
			            }
			        ]
			    },
			    {
			        "name": "daniel",
			        "data": [
			            {
			                "date": "2016-10-27",
			                "score": 164,
			                "day": 0
			            },
			            {
			                "date": "2016-10-28",
			                "score": 147,
			                "day": 1
			            },
			            {
			                "date": "2016-10-29",
			                "score": 136,
			                "day": 2
			            },
			            {
			                "date": "2016-10-30",
			                "score": 139,
			                "day": 3
			            },
			            {
			                "date": "2016-10-31",
			                "score": 139,
			                "day": 4
			            },
			            {
			                "date": "2016-11-01",
			                "score": 156,
			                "day": 5
			            },
			            {
			                "date": "2016-11-02",
			                "score": 144,
			                "day": 6
			            },
			            {
			                "date": "2016-11-03",
			                "score": 147,
			                "day": 7
			            },
			            {
			                "date": "2016-11-04",
			                "score": 153,
			                "day": 8
			            },
			            {
			                "date": "2016-11-05",
			                "score": 172,
			                "day": 9
			            },
			            {
			                "date": "2016-11-06",
			                "score": 166,
			                "day": 10
			            },
			            {
			                "date": "2016-11-07",
			                "score": 163,
			                "day": 11
			            },
			            {
			                "date": "2016-11-08",
			                "score": 145,
			                "day": 12
			            },
			            {
			                "date": "2016-11-09",
			                "score": 154,
			                "day": 13
			            },
			            {
			                "date": "2016-11-10",
			                "score": 167,
			                "day": 14
			            },
			            {
			                "date": "2016-11-11",
			                "score": 151,
			                "day": 15
			            },
			            {
			                "date": "2016-11-12",
			                "score": 149,
			                "day": 16
			            },
			            {
			                "date": "2016-11-13",
			                "score": 150,
			                "day": 17
			            },
			            {
			                "date": "2016-11-14",
			                "score": 166,
			                "day": 18
			            },
			            {
			                "date": "2016-11-15",
			                "score": 150,
			                "day": 19
			            },
			            {
			                "date": "2016-11-16",
			                "score": 163,
			                "day": 20
			            },
			            {
			                "date": "2016-11-17",
			                "score": 151,
			                "day": 21
			            },
			            {
			                "date": "2016-11-18",
			                "score": 187,
			                "day": 22
			            },
			            {
			                "date": "2016-11-19",
			                "score": 175,
			                "day": 23
			            },
			            {
			                "date": "2016-11-20",
			                "score": 156,
			                "day": 24
			            },
			            {
			                "date": "2016-11-21",
			                "score": 156,
			                "day": 25
			            },
			            {
			                "date": "2016-11-22",
			                "score": 156,
			                "day": 26
			            },
			            {
			                "date": "2016-11-23",
			                "score": 173,
			                "day": 27
			            },
			            {
			                "date": "2016-11-24",
			                "score": 173,
			                "day": 28
			            },
			            {
			                "date": "2016-11-25",
			                "score": 154,
			                "day": 29
			            },
			            {
			                "date": "2016-11-26",
			                "score": 156,
			                "day": 30
			            },
			            {
			                "date": "2016-11-27",
			                "score": 157,
			                "day": 31
			            },
			            {
			                "date": "2016-11-28",
			                "score": 159,
			                "day": 32
			            },
			            {
			                "date": "2016-11-29",
			                "score": 159,
			                "day": 33
			            },
			            {
			                "date": "2016-11-30",
			                "score": 171,
			                "day": 34
			            },
			            {
			                "date": "2016-12-01",
			                "score": 156,
			                "day": 35
			            },
			            {
			                "date": "2016-12-02",
			                "score": 158,
			                "day": 36
			            },
			            {
			                "date": "2016-12-03",
			                "score": 159,
			                "day": 37
			            },
			            {
			                "date": "2016-12-04",
			                "score": 161,
			                "day": 38
			            },
			            {
			                "date": "2016-12-05",
			                "score": 177,
			                "day": 39
			            },
			            {
			                "date": "2016-12-06",
			                "score": 164,
			                "day": 40
			            },
			            {
			                "date": "2016-12-07",
			                "score": 180,
			                "day": 41
			            },
			            {
			                "date": "2016-12-08",
			                "score": 163,
			                "day": 42
			            },
			            {
			                "date": "2016-12-09",
			                "score": 160,
			                "day": 43
			            },
			            {
			                "date": "2016-12-10",
			                "score": 174,
			                "day": 44
			            },
			            {
			                "date": "2016-12-11",
			                "score": 157,
			                "day": 45
			            },
			            {
			                "date": "2016-12-12",
			                "score": 154,
			                "day": 46
			            },
			            {
			                "date": "2016-12-13",
			                "score": 158,
			                "day": 47
			            },
			            {
			                "date": "2016-12-14",
			                "score": 153,
			                "day": 48
			            },
			            {
			                "date": "2016-12-15",
			                "score": 157,
			                "day": 49
			            },
			            {
			                "date": "2016-12-16",
			                "score": 160,
			                "day": 50
			            },
			            {
			                "date": "2016-12-17",
			                "score": 196,
			                "day": 51
			            },
			            {
			                "date": "2016-12-18",
			                "score": 194,
			                "day": 52
			            },
			            {
			                "date": "2016-12-19",
			                "score": 160,
			                "day": 53
			            },
			            {
			                "date": "2016-12-20",
			                "score": 157,
			                "day": 54
			            },
			            {
			                "date": "2016-12-21",
			                "score": 161,
			                "day": 55
			            },
			            {
			                "date": "2016-12-22",
			                "score": 159,
			                "day": 56
			            },
			            {
			                "date": "2016-12-23",
			                "score": 159,
			                "day": 57
			            },
			            {
			                "date": "2016-12-24",
			                "score": 162,
			                "day": 58
			            },
			            {
			                "date": "2016-12-25",
			                "score": 161,
			                "day": 59
			            },
			            {
			                "date": "2016-12-26",
			                "score": 176,
			                "day": 60
			            },
			            {
			                "date": "2016-12-27",
			                "score": 176,
			                "day": 61
			            }
			        ]
			    }
			]
		);
	}

}

export default UserGraphTest;