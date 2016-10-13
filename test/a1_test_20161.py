import user_submission as tweet
import unittest

correctness = [0, 0, 0, 0, 0, 0, 0]
total = [10, 10, 10, 12, 12, 10, 13]
function_names = ['contains_owly_url_only',
                  'is_valid_tweet',
                  'add_hashtag',
                  'contains_hashtag',
                  'report_longest',
                  'num_tweets_required',
                  'get_nth_tweet']

class TestTweetLength50(unittest.TestCase):
    def setUp(self):
        tweet.MAX_TWEET_LENGTH = 50
        tweet.HASH = '#'

    def test_contains_owly_url_only(self):
        self.assertTrue(tweet.contains_owly_url('http://ow.ly/'))
        correctness[0] += 1

    def test_contains_owly_url_start(self):
        self.assertTrue(tweet.contains_owly_url('http://ow.ly/anything here'))
        correctness[0] += 1

    def test_contains_owly_url_end(self):
        self.assertTrue(tweet.contains_owly_url('end with http://ow.ly/'))
        correctness[0] += 1

    def test_contains_owly_url_end_with_content(self):
        self.assertTrue(tweet.contains_owly_url('end with http://ow.ly/something'))
        correctness[0] += 1

    def test_contains_owly_url_with_invalid_hashtag(self):
        self.assertTrue(tweet.contains_owly_url('http://ow.ly/#hashtag'))
        correctness[0] += 1

    def test_contains_owly_url_with_hashtag(self):
        self.assertTrue(tweet.contains_owly_url('#hashtag http://ow.ly/hello'))
        correctness[0] += 1

    def test_contains_owly_url_invalid_1(self):
        self.assertFalse(tweet.contains_owly_url('abchttp://ow.ly/'))
        correctness[0] += 1

    def test_contains_owly_url_invalid_2(self):
        self.assertFalse(tweet.contains_owly_url('http://0w.ly/'))
        correctness[0] += 1

    def test_contains_owly_url_invalid_3(self):
        self.assertFalse(tweet.contains_owly_url('http://ow.ly'))
        correctness[0] += 1

    def test_contains_owly_url_invalid_4(self):
        self.assertFalse(tweet.contains_owly_url('ow.ly/something'))
        correctness[0] += 1

    def test_is_valid_tweet_empty(self):
        self.assertFalse(tweet.is_valid_tweet(''))
        correctness[1] += 1

    def test_is_valid_tweet_with_hashtag(self):
        self.assertTrue(tweet.is_valid_tweet('#hi valid?' * 3))
        correctness[1] += 1

    def test_is_valid_tweet_lower_limit_length(self):
        self.assertTrue(tweet.is_valid_tweet('1'))
        correctness[1] += 1

    def test_is_valid_tweet_upper_limit_length(self):
        self.assertTrue(tweet.is_valid_tweet('1234567890' * 5))
        correctness[1] += 1

    def test_is_valid_tweet_exceed(self):
        self.assertFalse(tweet.is_valid_tweet('1234567890' * 5 + ' '))
        correctness[1] += 1

    def test_add_hashtag_sample(self):
        self.assertEqual(tweet.add_hashtag('test test', 'test'), 'test test #test')
        correctness[2] += 1

    def test_add_hashtag_empty_hashtag(self):
        self.assertEqual(tweet.add_hashtag('test test', ''), 'test test #')
        correctness[2] += 1

    def test_add_hashtag_with_hash_symbol(self):
        self.assertEqual(tweet.add_hashtag('test test', '#test'), 'test test ##test')
        correctness[2] += 1

    def test_add_hashtag_tweet_lower_limit_length(self):
        self.assertEqual(tweet.add_hashtag('1', 'test'), '1 #test')
        correctness[2] += 1

    def test_add_hashtag_upper_limit_length(self):
        self.assertEqual(tweet.add_hashtag('.' * 44, 'test'), '.' * 44 + ' #test')
        correctness[2] += 1

    def test_add_hashtag_exceed(self):
        self.assertEqual(tweet.add_hashtag('.' * 45, 'test'), '.' * 45)
        correctness[2] += 1

    def test_contains_hashtag_start(self):
        self.assertTrue(tweet.contains_hashtag('#hash test test', '#hash'))
        correctness[3] += 1

    def test_contains_hashtag_end(self):
        self.assertTrue(tweet.contains_hashtag('test test #hash', '#hash'))
        correctness[3] += 1

    def test_contains_hashtag_middle(self):
        self.assertTrue(tweet.contains_hashtag('test #hash test', '#hash'))
        correctness[3] += 1

    def test_contains_hashtag_empty(self):
        self.assertTrue(tweet.contains_hashtag('#', '#'))
        correctness[3] += 1

    def test_contains_hashtag_multiple_1(self):
        self.assertTrue(tweet.contains_hashtag('#hash #t test', '#hash'))
        correctness[3] += 1

    def test_contains_hashtag_multiple_2(self):
        self.assertTrue(tweet.contains_hashtag('#test test #t', '#t'))
        correctness[3] += 1

    def test_contains_hashtag_double_hash(self):
        self.assertTrue(tweet.contains_hashtag('test ##hash', '##hash'))
        correctness[3] += 1

    def test_contains_hashtag_with_hash(self):
        self.assertTrue(tweet.contains_hashtag('test #hash#t', '#hash#t'))
        correctness[3] += 1

    def test_contains_hashtag_invalid_1(self):
        self.assertFalse(tweet.contains_hashtag('test #test', '#t'))
        correctness[3] += 1

    def test_contains_hashtag_invalid_2(self):
        self.assertFalse(tweet.contains_hashtag('test #test#t', '#t'))
        correctness[3] += 1

    def test_report_longest_first(self):
        self.assertEqual(tweet.report_longest('01' * 10, '2' * 10), 'Tweet 1')
        correctness[4] += 1

    def test_report_longest_second(self):
        self.assertEqual(tweet.report_longest('1' * 10, '02' * 10), 'Tweet 2')
        correctness[4] += 1

    def test_report_longest_same(self):
        self.assertEqual(tweet.report_longest('01' * 10, '02' * 10), 'Same length')
        correctness[4] += 1

    def test_report_longest_with_hashtag(self):
        self.assertEqual(tweet.report_longest('#test ' * 5, 'what??' * 5), 'Same length')
        correctness[4] += 1

    def test_report_longest_limit_length_first(self):
        self.assertEqual(tweet.report_longest('1234567890' * 5, '1'), 'Tweet 1')
        correctness[4] += 1

    def test_report_longest_limit_length_second(self):
        self.assertEqual(tweet.report_longest('1', '0987654321' * 5), 'Tweet 2')
        correctness[4] += 1

    def test_report_longest_lower_limit_length_same(self):
        self.assertEqual(tweet.report_longest('1' * 50, '0' * 50), 'Same length')
        correctness[4] += 1

    def test_report_longest_upper_limit_length_same(self):
        self.assertEqual(tweet.report_longest('1234567890' * 5, '0987654321' * 5), 'Same length')
        correctness[4] += 1

    def test_num_tweets_required_empty(self):
        self.assertEqual(tweet.num_tweets_required(''), 0)
        correctness[5] += 1

    def test_num_tweets_required_one(self):
        self.assertEqual(tweet.num_tweets_required('test'), 1)
        correctness[5] += 1

    def test_num_tweets_required_lower_limit_length(self):
        self.assertEqual(tweet.num_tweets_required('1'), 1)
        correctness[5] += 1

    def test_num_tweets_required_upper_limit_length(self):
        self.assertEqual(tweet.num_tweets_required('1234567890' * 5), 1)
        correctness[5] += 1

    def test_num_tweets_required_more(self):
        self.assertEqual(tweet.num_tweets_required('What does the fox say?' * 5), 3)
        correctness[5] += 1

    def test_num_tweets_required_more_limit_length(self):
        self.assertEqual(tweet.num_tweets_required('12345678901234567890' * 5), 2)
        correctness[5] += 1

    def test_get_nth_tweet_empty(self):
        self.assertEqual(tweet.get_nth_tweet('', 1), '')
        correctness[6] += 1

    def test_get_nth_tweet_short_1(self):
        self.assertEqual(tweet.get_nth_tweet('test' * 10, 1), 'test' * 10)
        correctness[6] += 1

    def test_get_nth_tweet_short_2(self):
        self.assertEqual(tweet.get_nth_tweet('test' * 10, 2), '')
        correctness[6] += 1

    def test_get_nth_tweet_limit_length_1(self):
        self.assertEqual(tweet.get_nth_tweet('1234567890' * 5, 1), '1234567890' * 5)
        correctness[6] += 1

    def test_get_nth_tweet_limit_length_2(self):
        self.assertEqual(tweet.get_nth_tweet('1234567890' * 5, 2), '')
        correctness[6] += 1

    def test_get_nth_tweet_long_1(self):
        self.assertEqual(tweet.get_nth_tweet('What does the fox say?' * 5, 1),
                         ('What does the fox say?' * 5)[:50])
        correctness[6] += 1

    def test_get_nth_tweet_long_2(self):
        self.assertEqual(tweet.get_nth_tweet('What does the fox say?' * 5, 3),
                         ('What does the fox say?' * 5)[100:150])
        correctness[6] += 1

    def test_get_nth_tweet_long_3(self):
        self.assertEqual(tweet.get_nth_tweet('What does the fox say?' * 5, 10), '')
        correctness[6] += 1


class TestTweetLength10(unittest.TestCase):
    def setUp(self):
        tweet.MAX_TWEET_LENGTH = 10
        tweet.HASH = '#'

    def test_is_valid_tweet_empty(self):
        self.assertFalse(tweet.is_valid_tweet(''))
        correctness[1] += 1

    def test_is_valid_tweet_with_hashtag(self):
        self.assertTrue(tweet.is_valid_tweet('#hi valid?'))
        correctness[1] += 1

    def test_is_valid_tweet_lower_limit_length(self):
        self.assertTrue(tweet.is_valid_tweet('1'))
        correctness[1] += 1

    def test_is_valid_tweet_upper_limit_length(self):
        self.assertTrue(tweet.is_valid_tweet('1234567890'))
        correctness[1] += 1

    def test_is_valid_tweet_exceed(self):
        self.assertFalse(tweet.is_valid_tweet('1234567890-'))
        correctness[1] += 1

    def test_add_hashtag_tweet_lower_limit_length(self):
        self.assertEqual(tweet.add_hashtag('1', 'test'), '1 #test')
        correctness[2] += 1

    def test_add_hashtag_upper_limit_length(self):
        self.assertEqual(tweet.add_hashtag('test', 'test'), 'test #test')
        correctness[2] += 1

    def test_add_hashtag_exceed(self):
        self.assertEqual(tweet.add_hashtag('long test', '#test'), 'long test')
        correctness[2] += 1

    def test_report_longest_limit_length_first(self):
        self.assertEqual(tweet.report_longest('1234567890', '1'), 'Tweet 1')
        correctness[4] += 1

    def test_report_longest_limit_length_second(self):
        self.assertEqual(tweet.report_longest('1', '0987654321'), 'Tweet 2')
        correctness[4] += 1

    def test_report_longest_lower_limit_length_same(self):
        self.assertEqual(tweet.report_longest('1', '0'), 'Same length')
        correctness[4] += 1

    def test_report_longest_upper_limit_length_same(self):
        self.assertEqual(tweet.report_longest('1234567890', '0987654321'), 'Same length')
        correctness[4] += 1

    def test_num_tweets_required_lower_limit_length(self):
        self.assertEqual(tweet.num_tweets_required('1'), 1)
        correctness[5] += 1

    def test_num_tweets_required_upper_limit_length(self):
        self.assertEqual(tweet.num_tweets_required('1234567890'), 1)
        correctness[5] += 1

    def test_num_tweets_required_more(self):
        self.assertEqual(tweet.num_tweets_required('What does the fox say?'), 3)
        correctness[5] += 1

    def test_num_tweets_required_more_limit_length(self):
        self.assertEqual(tweet.num_tweets_required('12345678901234567890'), 2)
        correctness[5] += 1

    def test_get_nth_tweet_limit_length_1(self):
        self.assertEqual(tweet.get_nth_tweet('1234567890', 1), '1234567890')
        correctness[6] += 1

    def test_get_nth_tweet_limit_length_2(self):
        self.assertEqual(tweet.get_nth_tweet('1234567890', 2), '')
        correctness[6] += 1

    def test_get_nth_tweet_long_1(self):
        self.assertEqual(tweet.get_nth_tweet('What does the fox say?', 1), 'What does ')
        correctness[6] += 1

    def test_get_nth_tweet_long_2(self):
        self.assertEqual(tweet.get_nth_tweet('What does the fox say?', 3), 'y?')
        correctness[6] += 1

    def test_get_nth_tweet_long_3(self):
        self.assertEqual(tweet.get_nth_tweet('What does the fox say?', 10), '')
        correctness[6] += 1

class TestTweetHash(unittest.TestCase):
    def setUp(self):
        tweet.HASH = '$'
    
    def test_add_hashtag_dollar(self):
        self.assertEqual(tweet.add_hashtag('.', 'test'), '. $test')
        correctness[2] += 1
    
    def test_contains_hashtag_dollar(self):
        self.assertTrue(tweet.contains_hashtag('. $test', '$test'))
        correctness[3] += 1
    
    def test_contains_hashtag_dollar_false(self):
        self.assertFalse(tweet.contains_hashtag('. $test', '$t'))
        correctness[3] += 1    
        
if __name__ == '__main__':
    unittest.main(exit=False)

    string = ''    
    for i in range(7):
        string += '    ' + function_names[i] + ': ' + \
            str(correctness[i]) + '/' + str(total[i]) + '\n'
    string += 'Total: ' + str(sum(correctness)) + '/' + str(sum(total))
    
    file = open('test_result.txt', 'w')
    file.write(string)
    file.close()

    file = open('all_test_results/amount.txt')
    amount = int(file.readline()) + 1
    file.close()

    file = open('all_test_results/amount.txt', 'w')
    file.write(str(amount))
    file.close()

    file = open('all_test_results/test_result_' + str(amount) + '.txt', 'w')
    file.write(string)
    file.close()
